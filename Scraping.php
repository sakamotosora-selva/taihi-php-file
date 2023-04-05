<?php
namespace App\Library\Scraping;

use Illuminate\Support\Facades\DB;
use App\Model\ScrapingList;
use App\Model\Recruitment;
use App\Model\RecruitmentFreeItem;
use App\Facades\ConfigMaster;
use Monolog\Logger;
use App\Model\RecruitmentOptionIds2;
use App\Model\RecruitmentOptionIds3;
use App\Model\RecruitmentOptionIds4;
use App\Model\RecruitmentOptionIds5;
use App\Model\RecruitmentOptionIds6;


/**
 * スクレイピング用ライブラリ
 * Scraping
 *  |-Scraping.php          スクレイピング用基クラス
 *  |                       makeJobList()：取得対象求人のURL一覧作成
 *  |                       getJobData() ：求人情報取得
 *  |                       loadJobData()：求人情報取り込み
 *  |
 *  |-simple_html_dom.php   HTMLパーサクラス
 *  |
 *  |-ScrapingGREEN.php         GREEN用スクレイピングクラス   
 *  |-ScrapingCareeela.php      Careeela用スクレイピングクラス   
 *  |-ScrapingTechStock.php     TechSTOCK用スクレイピングクラス   
 *  |-ScrapingTechStock_24.php   TechSTOCK用スクレイピングクラス SiteID:24の場合のオーバーライド（自由項目取込のカスタマイズ）
 * 
 */



/**
 * スクレイピングのインターフェイス
 */
interface ScrapingAction
{

    /**
     * 求人詳細ページ取得先のURL作成
     */
    public function makeJobList();

    /**
     * 求人詳細データ取得
     */
    public function getJobData();

    /**
     * データロード CSV
     */
    public function loadJobData();

}

/**
 * 他サイトからのデータ取得用クラス
 * 各サイトごとに子クラス ScrapingKokurasu を作ってインスタンス化する
 * 
 */
class Scraping implements ScrapingAction {

    // protected $strUserAgent;        // UserAgent
    protected $strTargetUrlBase;    // 取得先サイトのベースURL（URLの不可変部分）
    protected $strTargetUrl;        // 取得先サイトの初回アクセスURL（URLの可変部分）
    protected $listStartPage;       // 求人詳細ページURLリスト取得開始ページ
    protected $strSiteId;           // 取得先サイトのID
    protected $strServiceId;        // 取得先サービスのID・・・config('master.scraping_service')参照
    protected $log;                 // ロガー
    protected $maxPageUrlCount;     // 取得URLの最大数 null以外はテスト用

    protected $recruitmentDataColumns   = [ // 求人票データ項目
        'date_id',
        'foreign_id',
        'is_valid',
        'agency_name',
        'is_shown',
        'valid_start',
        'valid_end',
        'plan_id',
        'by_external_link',
        'corporate_id',
        'source_company_name',
        'source_media_name',
        'source_site_url',
        'facility_name',
        'zip',
        'pref_id',
        'city_id',
        'address',
        'access',
        'search_item_option_ids_2',
        'search_item_option_ids_3',
        'search_item_option_ids_4',
        'search_item_option_ids_5',
        'search_item_option_ids_6',
        'is_enabled_remote',
        'is_enabled_daily_payment',
        'name',
        'job_category',
        'pr_text',
        'pr_image',
        'employment_type',
        'requirement',
        'job_detail',
        'job_time',
        'income',
        'income_type',
        'income_min',
        'income_max',
        'holiday',
        'treatment',
        'screening_method',
        'numbers',
        'tags',
        'state_id',
        'is_hellowork',
        'is_set_search_item',
        'recruitment_tags',
    ];


    function __construct(){
        if( !$this->strTargetUrlBase || !$this->strSiteId ) throw new \Exception('SiteID or TargetURL is not found.');
        // $this->strUserAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36";
        $this->maxPageUrlCount = null;    // 0:全件取得 1:10件取得
    }   

    /**
     * 求人詳細ページ取得先のURL配列作成
     * @return void
     */
    public function makeJobList(){
        // URLリスト作成
        $arrDetailPageUrls = $this->makeUrlList();

        // URLリスト退避
        $this->saveCache( 'urlList', $arrDetailPageUrls );
    }


    /**
     * 求人データHTML取得 項目抽出
     * @return void
     */
    public function getJobData(){

        // 退避データ読込
        $arrDetailPageUrls = $this->loadCache( 'urlList' );
        if( count($arrDetailPageUrls) == 0 ) return false;

        // URLリストの詳細ページを取得する
        $arrJobData = $this->getDetailPages( $arrDetailPageUrls );

        // 取得データ退避
        $this->saveCache( 'jobData', $arrJobData );

    }

    /**
     * データロード共通
     * @return void
     */
    public function loadJobData(){
        
        // 退避データ読込
        $arrJobDatas =  $this->loadCache( 'jobData' );
        if( count($arrJobDatas) == 0 ) return false;

        DB::beginTransaction();
        try {

            // $this->log_output($this->strServiceId);
            // dds("かかかか");

            /**
             * ScrapingList(前回取得分)にあって今回取得分に無いURLは Recruitment,ScrapingList から削除する
             */
            // ScrapingListの読込
            $scraping_list = ScrapingList::where('scraping_site',  ConfigMaster::getSelectName('scraping_service', $this->strServiceId ) )->get();
            // dds($scraping_list);
            // 今回取得分url のみの配列
            $arrNewUrl = array_column($arrJobDatas,'source_site_url');

            $count_delete = 0;
            /** @var ScrapingList $scraping_data */
            foreach( $scraping_list as $scraping_data ){
                // 今回取得分に無いURLは recruitment,ScrapingList から削除
                if( !in_array( $scraping_data->scraping_url ,$arrNewUrl ) ){
                    $count_delete++;
                    // $this->log_output("OLD-1 NEW-0 :".$scraping_data->scraping_url);                    
                    $recruitment = Recruitment::find($scraping_data->recruitments_id);
                    if( $recruitment ) {
                        $recruitment->delete();
                        $recruitment->save();
                    }

                    // // recruitmentFreeItem のデリート処理 */
                    // $recruitmentFreeItem = new RecruitmentFreeItem();
                    // $recruitmentFreeItem->deleteByRecruitmentId($scraping_data->recruitments_id);
                    // $recruitmentFreeItem->save();

                    $scraping_data->delete();
                    $scraping_data->save();

                    unset($recruitment);
                    // unset($recruitmentFreeItem);
                }
            }
            $this->log_output("{$count_delete}件のデータを削除");

            /**
             *  今回取得分にあるURLは Recruitment,ScrapingList を Upsert する
             */ 
            foreach( $arrJobDatas as $arrJobData ){

                // 登録用の配列用意(余分な項目(free_itemsなど)排除)
                $dataRec  = [];     // Recruitment用の配列
                foreach( $this->recruitmentDataColumns as  $recruitmentDataColumn ){
                    $dataRec[$recruitmentDataColumn] = $arrJobData[$recruitmentDataColumn];
                }
                // dds($dataRec);
                $dataFreeItems = [];     // RecruitmentFreeItem用の配列
                if( !empty($arrJobData['free_items']) ){
                    $dataFreeItems = $arrJobData['free_items'];
                }

                //Recruitmentの登録処理
                $recruitment = Recruitment::withTrashed()->updateOrCreate(
                    ['foreign_id' => $dataRec['foreign_id']],
                    $dataRec
                );
                
                // ソフトデリート済のものは復活
                if ($recruitment->deleted_at) {
                    $recruitment->restore();
                }
                $recruitment->save();

                // free_items の登録処理
                foreach( $dataFreeItems as $dataFreeItemID => $dataFreeItemVal ){
                    $recruitmentFreeItem = RecruitmentFreeItem::withTrashed()->updateOrCreate(
                        ['recruitment_id' => $recruitment['id'], 'free_item_id' => $dataFreeItemID ],
                        ['recruitment_id' => $recruitment['id'], 'free_item_id' => $dataFreeItemID , 'value' => $dataFreeItemVal]
                    );
                    // ソフトデリート済のものは復活
                    if ($recruitmentFreeItem->deleted_at) {
                        $recruitmentFreeItem->restore();
                    }
                    $recruitmentFreeItem->save();
                    unset($recruitmentFreeItem);
                }

                $this->log_output('から');
                // 一度以下をコメントアウト（エラーがおきるため）
                // 今回はscrapinlistは必要なのか

                // $scrapingList = ScrapingList::withTrashed()->updateOrCreate(
                //     ['recruitments_id' => $recruitment['id'], 'scraping_site' => $recruitment['agency_name'] ],
                //     ['recruitments_id' => $recruitment['id'], 'scraping_site' => $recruitment['agency_name'], 'scraping_url' => $arrJobData['source_site_url'], 'deleted_at' => null ]
                // );
                // if ($scrapingList->deleted_at) {
                //     $scrapingList->restore();
                // }
                // $scrapingList->save();
                
                unset( $dataRec );
                unset( $dataFree );
                unset($recruitment);
                // unset($scrapingList);

            }
            $this->log_output(count($arrJobDatas)."件のデータを追加更新");
            
            DB::commit();
        } catch (\Exception $e) {
            $this->log_output("Error has occured:".$e->getMessage());
            DB::rollback();
        }

    }

    
    /**
     * キャッシュの一時出力
     * @param string $type キャッシュのタイプ識別子
     * @param array $arrUrlList
     * @return void
     */
    protected function saveCache( $type, $arrData ){

        switch( $type ){
            case 'urlList': // makeJobList 求人詳細ページ取得先のURL配列退避
            case 'jobData': // getJobData 求人データHTML抽出項目 recruitment配列退避
                $file_path = storage_path()."/tmp/Scraping".$this->strSiteId.$this->strServiceId.ucfirst($type);
                file_put_contents($file_path, serialize($arrData), LOCK_EX);
                chmod($file_path, 0644);
                break;
        }
        $this->log_output( 'Save '.$type.'['.$file_path.']:' . count($arrData) . " rec" );

    }

    /**
     * 一時出力キャッシュの読込
     * @param string $type キャッシュのタイプ識別子
     * @return array 
     */
    protected function loadCache( $type ){
        
        switch( $type ){
            case 'urlList': // getJobData  求人詳細ページ取得先のURL配列
            case 'jobData': // loadJobData 求人データHTML抽出項目 recruitment配列
                $file_path = storage_path()."/tmp/Scraping".$this->strSiteId.$this->strServiceId.ucfirst($type);
                $data_serialize = file_get_contents($file_path);
                $arrData = unserialize($data_serialize);
                break;
        }
        $this->log_output( 'Load '.$type.'['.$file_path.']:' . count($arrData) . " rec" );
        return $arrData;
        
    }
    
    /**
     * サイト別の作業メソッド呼び出し用 作業番号は901以降の数字で各クラス任意に採番
     * 番号で処理を合わせると後になって識別しやすいかもしれません（例：CSV吐出など）
     * @param int $workId 作業No
     */
    public function doWork( $workId ){

        $this->_doWork( $workId );

    }

    /**
     * 求人詳細ページURLのリスト作成
    * @return void
    */
    protected function makeUrlList(){
        // 個別のクラスで実装
    }

    /**
     * URLリストの求人詳細ページを取得していく
     */
    protected function getDetailPages( $arrDetailPageUrls ){
        // 個別のクラスで実装
    }

    /**
     * データロード
     */
    protected function loadData(){
        // 個別のクラスで実装
    }

    
    /**
     * クラス別の作業用メソッド、取得項目の事前確認など 作業番号は901以降の数字で採番
     * @param int $workId 作業No
     */
    protected function _doWork( $workId ){
        // 個別のクラスで実装
    }

    /**
     * 確認用：jobDataキャッシュ（Recruitment配列）CSV出力
     * @return void
     */
    protected function outputRecruitmentCacheData( ){

        // 初期設定
        $separater = "\t";
        $csvFileName = storage_path().'/tmp/Scraping'.$this->strSiteId.$this->strServiceId."Csv_".time().'.csv';

        //// データ取得
        $arrDataItams =  $this->loadCache( 'jobData' );
        $originDataTitle = array_keys($arrDataItams[0]);

       $this->csvOutputDataItems( $csvFileName ,$originDataTitle, $arrDataItams, $separater);

    }


    /**
     * CSV出力
     *
     * @param string $csvFileName
     * @param array $originDataTitle
     * @param array $arrDataItams
     * @param string $separater
     * @return void
     */
    protected function csvOutputDataItems( $csvFileName ,$originDataTitle, $arrDataItams, $separater = ','){
        // ファイルポインタ取得
        $fp = fopen($csvFileName, 'w');
        if ( !$fp ) {
            throw new \Exception('ファイルの書き込みに失敗しました。');
        }

        // ヘッダ出力
        fputcsv( $fp,  $originDataTitle, $separater);
    
        // 配列ループ
        foreach( $arrDataItams as $arrDataItam){
            // 自由項目欄は配列を結合して出力
            foreach($arrDataItam as $keyCol => $arrDataItamCol ){
                if( is_array($arrDataItamCol) ){
                    $_arrDataItamCol = [];
                    foreach($arrDataItamCol as $keyFee => $val ){
                        $_arrDataItamCol[] = "$keyFee:".$val;
                    }
                    $arrDataItam[$keyCol] = implode("\n", $_arrDataItamCol);
                }
            }
            // 出力
            fputcsv( $fp, $arrDataItam, $separater);
        }

        // ファイルポインタ解放
        fclose($fp);

    }
    
    /**
     * ログ吐き出し
     *
     * @param string $message
     */
    protected function log_output( $message ){
        $memInfo =  ' [mem:'.number_format(memory_get_usage() / 1048576, 2).'MB]';
        echo($message.$memInfo."\n");
        $path = 'scraping/' . $this->strServiceId . '/' . $this->strSiteId;
        \CustomLog::put('info', $path, $message);
        \CustomLog::put('info', $path, $memInfo);
    }
    
    /**
     * 給与形態によって、ある程度正しい値か判断する
     *
     * @return bool
     */

    public function check_income($type,$income_min,$income_max){
        $income_min_len = strlen($income_min);
        $income_max_len = strlen($income_max);
        $allow_len_low = null;
        $allow_len_high = null;

        switch ($type) {
        case 1:
            // 年収は7桁か8桁かのみ許容
            $allow_len_low = 7;
            $allow_len_high = 8;
          break;
        case 2:
            // 月給は6桁のみ許容
            $allow_len_low = 6;
            $allow_len_high = 6;
          break;
        case 3:
            // 日給は4桁か5桁かのみ許容
            $allow_len_low = 4;
            $allow_len_high = 5;
          break;
        case 4:
            // 時給は3桁か4桁かのみ許容
            $allow_len_low = 3;
            $allow_len_high = 4;
          break;
        default:
            return false;
        }
        // 下限が上限を超えていたらfalseを返す。
        if (!is_null($income_max) && ($income_min> $income_max) ) {
            return false;
        }

        // 給与形態ごとの許容桁数ならtrueを返す
        if ( ($income_min_len == $allow_len_low || $income_min_len == $allow_len_high) && ($income_max_len == $allow_len_low || $income_max_len == $allow_len_high || $income_max_len == null) ) {
            return true;
        }

        return false;
    }

    /**
     * HTMLからインポート用テキストに変換する処理
     * 1.改行コードを削除（$left_nl == falseなら）
     * 2.<br>タグを改行コードに変換
     * 3.ほかのタグを削除（$left_tags == falseなら）
     * 
     * @param string $string
     * @param bool $left_nl もともとの改行コードを残すか false：削除
     * @param bool $left_tags <br>以外のタグを残すか false：削除
     * @return string <br>を改行コードに変換した文字列
     */
    public function cnvH2T($string, $left_nl = false, $left_tags = false){
        if( !$left_nl ) {
            $string = str_replace( PHP_EOL, '', $string );  // 改行削除
            $string = preg_replace('/\t+/', '', $string);  // タブ削除
        }
        $string = preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "\n", $string);
        if( !$left_tags ) {
            $string = strip_tags ( $string );
        }
        return  trim($string);
    }

}
