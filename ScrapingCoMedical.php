<?php

namespace App\Library\Scraping;
// include('simple_html_dom.php');

use App\Facades\ConfigMaster;
use App\Model\ScrapingWork;

use Weidner\Goutte\GoutteFacade;
use Goutte\Client;
use App\Model\MstPref;
use App\Model\MstCity;
use App\Model\MstTown;
use Exception;
use App\Model\SearchItem;
use App\Model\SearchItemOption;
use App\Model\FreeItem;
use Datetime;

/**
 * 
 * マイナビ保育のスクレイピングを行うクラス
 * 
 * コピーして利用する場合は、
 * ・クラス名を ScrapingXxxxx（Xxxxxはサービス識別ID） とする
 * ・config/master.php scraping_service にサービス識別IDを追記する
 * ・Goutteを使う場合は ↑ のinclude('simple_html_dom.php'); は削除可能
 * 
 * ファイル設置後、
 * > composer dump-autoload
 * の実行が必要
 * 
 */

class ScrapingHoitomo extends Scraping
{
    /**
     * コンストラクタ
     * @param string $strSiteId サイトID
     * @param Logger|null $log ロガー
     */
    function __construct($strSiteId, $log = null)
    {
        print "マイナビ保育士のスクレイピングの処理を記述";
        // exit;

        $this->strSiteId            = $strSiteId;                                   // 取得先サイトのID
        $this->strTargetUrlBase     = 'https://www.hoitomo.jp/';                    // 取得先サイトのベースURL（URLの不可変部分）
        $this->strTargetUrl         = 'all';                                // 取得先サイトの初回アクセスURL（URLの可変部分）新着順
        $this->listStartPage        = $this->strTargetUrlBase . $this->strTargetUrl;// 求人詳細ページURLリスト取得開始ページ
        $this->pageItemNum          = 30;                                           // １ページあたりの表示件数
        $this->strServiceId         = "Hoitomo";                                // 取得先サービスのID・・・config('master.scraping_service')参照
        $this->log                  = $log;                                         // ロガー
        $this->agency_name          = ConfigMaster::getSelectName('scraping_service', $this->strServiceId);
        $this->search_item2_options = $this->getSearchItem2Options();
        $this->search_item3_options = $this->getSearchItem3Options();
        $this->search_item4_options = $this->getSearchItem4Options();
        $this->search_item5_options = $this->getSearchItem5Options();
        $this->search_item6_options = $this->getSearchItem6Options();
        parent::__construct();
    }

        /**
     * 取得対象の求人詳細ページURLのリスト作成
     * @return array  求人詳細ページURL
     */
    protected function makeUrlList($process_range)
    {
        $urls = array();
        // 未ログイン状態で求人一覧にアクセス
        $list = GoutteFacade::request('GET', $this->strTargetUrlBase . $this->strTargetUrl);
        
        $hitNum = $list->filter('.result .hit')->text();
        
        $hitNum = preg_replace('/[^0-9]/', '', $hitNum);
        $last_page = ceil($hitNum / $this->pageItemNum);
        $this->log_output("Total pages:" . $last_page);

        //全ての求人をスクレイピングする場合
        // for ($page = 30; $page <= $last_page; $page++) { //
        for ($page = 40; $page <= 50; $page++) { //
        // for ($page = 47; $page <= 50; $page++) { //
        // for ($page = 1; $page <= 1; $page++) { //
            $list = GoutteFacade::request('GET', $this->strTargetUrlBase . 'all/?page=' . $page);
            $list->filter('.rec_li .sub_detail .btn_orange a')->each(function ($element) use (&$urls) {

                $urls[] = $element->attr('href');  
            });
            
            // スクレイピングする範囲によって分岐　（0:前回スクレイピング処理した部分まで、all:全データスクレイピング）
            // 前回取得した求人まで到達すれば、break
            // if($process_range === 0){
            //     $structured_data = $this->getStructuredData(end($urls));

            //     // dds($structured_data);
            //     if( !empty( $structured_data ) ){
            //         // 以下2行をサイトごとに変更する
            //         $arr_data = json_decode($structured_data[0], true);
            //         $date_posted = $arr_data['datePosted'];
            //         $date_posted = new Datetime($date_posted);
            //         // 前回取得した求人の日付
            //         $latestPostDate = $this->getLatestRecruitmentDate();
            //         // dd($date_posted);
            //         // dd($latestPostDate);
            //         if(!empty($date_posted) && !empty($latestPostDate)){
            //             if($date_posted < $latestPostDate){
            //                 break;
            //             }
            //         }
            //     }
            // }
            $this->log_output($last_page . 'ページ中' . $page . "ページ分のURLを取得");

        }
        // dds($urls);
        return array_unique($urls);

    }

    /**
     * URLリストの求人詳細ページを取得、recruitment項目抽出
     * 配列サイズが大きくなってメモリが逼迫した場合は、
     * ・条件で分割して処理する
     * ・ファイル→DBへの一時保存方法
     * の検討が必要
     * 
     * @param array $arrDetailPageUrls 詳細ページURL
     * @return array|null $arrDetailPageUrls 求人データ
     */

    // URLリストの詳細ページを取得する
    protected function getDetailPages($arrDetailPageUrls)
    {
        $arrJobData = [];
        $count      = 0;
        $count_NG   = 0;
        foreach ($arrDetailPageUrls as $detailPageUrl) {
            $this->log_output('DetailPG[' . ++$count . '/' . sizeof($arrDetailPageUrls) . ']:' . $detailPageUrl);

            $detailData = $this->getDetailPage($detailPageUrl);

            dumps($detailData);

            // 取得結果がnullでなければ
            if ($detailData) {
                $arrJobData[] = $detailData;
            } else {
                dumps("友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友友");
                $count_NG++;
            }
            sleep(1);
            
        }
        $this->log_output(sizeof($arrDetailPageUrls) . ' pages crawled. OK:' . sizeof($arrJobData) . ' NG:' . $count_NG);
        return $arrJobData;
    }

    /**
     * 求人詳細ページ取得
     * @param Client  $client Goutte client
     * @param string  $detailPageUrl 詳細ページURL
     * @return array 求人データ
     */
    protected function getDetailPage($detailPageUrl)
    {
        $retryCountMax = 1; // 最大取得回数
        // 取得先ページからデータが返らない場合は再取得
        $retryCount = 0;
        while (++$retryCount <= $retryCountMax) {

            $parsedData = $this->parseAndMakeArrayRecruitment($detailPageUrl);
            // $parsedData = $this->parseAndMakeArrayRecruitment("https://www.hoitomo.jp/osaka/izumi/11945/38254/");

            if ($parsedData) {
                $parsedData['scraping_url'] = $detailPageUrl;
                return $parsedData;
            }
            // $this->log_output("NG:retry_$retryCount");            
        }
        return  null;
    }

    /**
     * 求人詳細ページパース（recruitment項目抽出） CSV用行データ取得
     * @param Client  $client Goutte client
     * @param string $detailPageUrl 詳細ページURL
     * @return array 求人データ
     * 
     * @todo 処理実装
     * 
     */

     protected function parseAndMakeArrayRecruitment($detailPageUrl)
     {
        try {
             // 配列初期化
             $arrDetailData = array_combine($this->recruitmentDataColumns, array_fill(0, count($this->recruitmentDataColumns), null));
            $post = GoutteFacade::request('GET', $detailPageUrl);

            // date_id
            $arrDetailData['date_id'] = date('Ymd');

            // foreign_id
            $foreign_id_tmp = str_replace('https://www.hoitomo.jp/', '', $detailPageUrl);

            if (preg_match('/(\d+\/\d+)\/?$/', $foreign_id_tmp, $matches))
            {
                $foreign_id = $matches[1];
            }

            $arrDetailData['foreign_id'] = $foreign_id;
            // is_valid
            $arrDetailData['is_valid'] = 1; // 有効
            // agency_name
            $arrDetailData['agency_name'] =  $this->agency_name;
            // is_shown
            $arrDetailData['is_shown'] = 1;
            // valid_start
            $arrDetailData['valid_start'] = date('Y-m-d');
            // valid_end
            $arrDetailData['valid_end'] = '2025-12-31';
            // plan_id
            $arrDetailData['plan_id'] = 3; // 下位プラン
            // source_media_name
            $arrDetailData['source_media_name'] = $this->agency_name;
            // source_site_url
            $arrDetailData['source_site_url'] = $detailPageUrl;
            
            // zip
            $arrDetailData['zip'] = '';
            // is_enable_daily_payment
            $arrDetailData['is_enabled_daily_payment'] = 2;
            // name (詳細ページの題名)

            $arrDetailData['name'] = str_replace("<br>", "\n", $post->filter('.tit')->text());

            $arrDetailData['pr_text'] = str_replace("<br>", "\n", $post->filter('.read .txt')->text());

            // 業種取得
            $employment_data = $post->filter('.box_cate')->text();

            $keys = [];

            foreach ($this->search_item2_options as $key => $item2_string)
            {
                if (strpos($employment_data, $item2_string) !== false )
                {
                    $keys[] = $key;
                }
            }

            if (!empty($keys))
            {
                $arrDetailData['search_item_option_ids_2'] = implode(",", $keys);
            }

            $keys = [];

            // 雇用形態
            foreach ($this->search_item3_options as $key => $item3_string)
            {
                if (strpos($employment_data, $item3_string) !== false )
                {
                    $keys[] = $key;
                }
            }

            if (!empty($keys))
            {
                $arrDetailData['search_item_option_ids_3'] = implode(",", $keys);
            }
 
            //  タグ
            $tags = [];

            $post->filter('.point li img')->each(function ($table) use (&$tags) {
                $tags[] = $table->attr('alt');
            });

            if (isset($tags) && !is_null($this->search_item6_options)) {
                $item_option6_strings = $tags;
                $tmpArray = [];
                foreach($item_option6_strings as $item_option6_string) {
                    foreach($this->search_item6_options as $key => $search_item6_option) {
                        if ($search_item6_option == $item_option6_string) {
                            $tmpArray[] = $key;
                            // dump($tmpArray);
                        }
                    }
                }
                $arrDetailData['search_item_option_ids_6'] = implode(',', array_unique($tmpArray));
            }

            // dds($arrDetailData);

            // 募集要項
            $texts = [];
            $table_tr = $post->filter('.info table tr th , .info table tr td');

            $count = 0;
            $table_tr->each(function ($table) use (&$texts) {
                $texts[] = $table->text();
            });
            foreach ($texts as $text)
            {
                $count++;

                if ($text === "施設名")
                {
                    $arrDetailData['facility_name'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "施設形態")
                {
                    $arrDetailData['job_category'] = str_replace("<br>", "\n", $texts[$count]);
                    $gyoushu = $arrDetailData['job_category'];
                }

                if ($text === "給与")
                {
                    //18万900円 18万8818円 のような書式の場合、使いまわしの給与ロジックでは取得できない。
                    // ex) https://www.hoitomo.jp/osaka/higashiosaka/10991/39119
                    $incomeText = $texts[$count];
                    $arrDetailData['income'] = $incomeText;
                    $incomeText = str_replace(' ', '', $incomeText);
                    $incomeText = str_replace(' ', '', $incomeText);
                    $incomeText = str_replace('<br>','', $incomeText);
                    $incomeText = str_replace('　', '', $incomeText);
                    $incomeText = str_replace(',', '', $incomeText);
                    $incomeText = str_replace('、', '', $incomeText);
                    $income = str_replace("\n", '', $incomeText);

                    //データをxx円に整える
                    preg_match_all('/[0-9]+\.[0-9]+万/', $income,$match);
                    foreach($match[0] as $match){
                        if(isset($match)){
                            $num = str_replace('万','',$match);
                            $num = $num*10000;
                            $income = preg_replace('/[0-9]+\.[0-9]+万/',$num,$income,1);
                        }
                    }
                    preg_match_all('/[0-9]+万[0-9]*/', $income,$income_matches);

                    foreach ($income_matches[0] as $income_text) {
                        $num_man = mb_strstr( $income_text, '万', true);
                        $num_yen = mb_strstr( $income_text, '万');
                        $num_yen = str_replace('万','',$num_yen);
                        $num = (int) $num_man *10000 + (int) $num_yen;
                        $income = str_replace($income_text,$num,$income);
                    }
                    preg_match_all('/(「|\[|【)?(年収|年俸|月給|⽉給|時給|月収|日給)(」|\]|】)?(:|：|…)?[0-9]+(～|〜|-)[0-9]+円/',$income,$not_exit_yen_match);
                    foreach ($not_exit_yen_match[0] as $income_text) {
                        $str = preg_replace('/(～|〜|-)/','～円',$income_text);
                        $income = str_replace($income_text,$str,$income);
                    }
                    // 基本給のみの書式でかかれているページがあるため、使いまわしの給与ロジックに基本給を追加
                    preg_match('/(「|\[|【)?(年収|年俸|月給|⽉給|時給|月収|日給|基本給)(」|\]|】)?(:|：|…)?[0-9]+円(～|〜|-)?([0-9]+円)?/',$income,$match);
                    $income = $match[0] ?? false;

                    if($income){
                        $regex = '/([0-9]+円)/';
                        preg_match_all($regex, $income, $matches);

                        //「~」がある場合
                        if (preg_match('/(～|〜|-)[0-9]/', $income)) {
                            $arrDetailData['income_min'] = preg_replace('/円/', '', $matches[0][0]);
                            $arrDetailData['income_max'] = !empty($matches[0][1]) ? preg_replace('/円/', '', $matches[0][1]) : NULL;
                        } elseif (preg_match('/～|〜|-/', $income)) {
                            $arrDetailData['income_min'] = preg_replace('/円/', '', $matches[0][0]);
                            $arrDetailData['income_max'] = NULL;
                        }else {
                            $arrDetailData['income_min'] = isset($matches[0][0]) ? preg_replace('/円/', '', $matches[0][0]): NULL;
                            $arrDetailData['income_max'] = isset($matches[0][0]) ? preg_replace('/円/', '', $matches[0][0]) : NULL;
                        }

                        $regex = '/年収|年俸|月給|基本給|⽉給|時給|月収|日給/';
                        preg_match_all($regex, $income, $matches);
                        switch($matches[0][0]){
                        case '年俸':
                            $arrDetailData['income_type'] = 1;
                            break;
                        case '年収':
                            $arrDetailData['income_type'] = 1;
                            break;
                        case '月給':
                            $arrDetailData['income_type'] = 2;
                            break;
                        case '基本給':
                            $arrDetailData['income_type'] = 2;
                            break;
                        case '月収':
                            $arrDetailData['income_type'] = 2;
                            break;
                        case '日給':
                            $arrDetailData['income_type'] = 3;
                            break;
                        case '時給':
                            $arrDetailData['income_type'] = 4;
                            break;
                        default:
                            $arrDetailData['income_type'] = null;
                        }
                    }

                    // 間違った情報が入らないようにフィルター
                    if ( !$this->check_income($arrDetailData['income_type'],$arrDetailData['income_min'],$arrDetailData['income_max']) ) {
                        $arrDetailData['income_max'] = null;
                        $arrDetailData['income_min'] = null;
                        $arrDetailData['income_type'] = null;
                    }
                }

                if ($text === "休日・休暇")
                {
                    $arrDetailData['holiday'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "福利厚生")
                {
                    $arrDetailData['treatment'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "仕事内容")
                {
                    $arrDetailData['job_detail'] = str_replace("<br>", "\n", $texts[$count]);
                }
                if ($text === "勤務時間")
                {
                    $arrDetailData['job_time'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "住所")
                {
                    $zip = substr($texts[$count], 0, 8); 

                    $arrDetailData['zip'] = $zip;

                    $regex = '/(東京都|北海道|(?:京都|大阪)府|.{6,9}県)((?:四日市|廿日市|野々市|臼杵|かすみがうら|つくばみらい|いちき串木野)市|(?:杵島郡大町|余市郡余市|高市郡高取)町|.{3,12}市.{3,12}区|.{3,9}区|.{3,15}市(?=.*市)|.{3,15}市|.{6,27}町(?=.*町)|.{6,27}町|.{9,24}村(?=.*村)|.{9,24}村)(.*)/';
                    preg_match($regex, $texts[$count], $matches);

                    if (!empty($matches))
                    {
                        $pattern = "/\d+/";
    
                        $matches[1] = preg_replace($pattern, "", $matches[1]);
                    }

                    // 住所のID取得
                    if (isset($matches[1])) {
                        // pref_id
                        $matches[1] = str_replace('ｹ','ヶ',$matches[1]);
                        $pref = MstPref::where('name', $matches[1])->first();
                        if ($pref) {
                            $arrDetailData['pref_id'] = $pref->id;
                        } else {
                            // 正規表現で得た都道府県でMstPrefテーブルから都道府県が見つからなかった場合、
                            // 正規表現で得た都道府県の一文字目の除いてもう一度検索する
                            $pref = MstPref::where('name', mb_substr($matches[1], 1))->first();
                            if ($pref) {
                                $arrDetailData['pref_id'] = $pref->id;
                            } else {
                                $arrDetailData['pref_id'] = 0;
                            }
                        }

                        $tmpCity = $matches[2];

                        $tmpCity = preg_replace('/\s+/u', '', $tmpCity);

                        // city_id
                        $city = MstCity::where('name', $tmpCity)->first();
                        if ($city) {
                            $arrDetailData['city_id'] = $city->id;
                        } else {
                            $arrDetailData['city_id'] = 0;
                        }
                        $arrDetailData['address'] = $matches[3];

                        if (strpos($arrDetailData['address'], "地図を表示"))
                        {
                            $arrDetailData['address'] = str_replace("地図を表示", "", $arrDetailData['address']);
                        }

                    } else {
                        $arrDetailData['pref_id'] = 0;
                        $arrDetailData['city_id'] = 0;
                        $arrDetailData['address'] = '';
                    }

                    //市区町村のみ
                    $regex = '/((?:四日市|廿日市|野々市|臼杵|かすみがうら|つくばみらい|いちき串木野)市|(?:杵島郡大町|余市郡余市|高市郡高取)町|.{3,12}市.{3,12}区|.{3,9}区|.{3,15}市(?=.*市)|.{3,15}市|.{6,27}町(?=.*町)|.{6,27}町|.{9,24}村(?=.*村)|.{9,24}村)(.*)/';
                    preg_match($regex, $texts[$count], $matches);
                    if ($arrDetailData['city_id'] == 0 && isset($matches[1])) {
                        $matches[1] = str_replace('ｹ','ヶ',$matches[1]);
                        $city = MstCity::where('name', $matches[1])->first();
                        if ($city) {
                            $arrDetailData['city_id'] = $city->id ?? 0;
                            if ($arrDetailData['address'] == '') {
                                $arrDetailData['address'] =  $matches[2] ?? '';
                            }
                        }
                    }

                    //伊達市と府中市は２つ存在するので、特別に判定
                    if (isset($city) && ($city->name == '伊達市' || $city->name == '府中市')) {
                        $city_id = MstCity::where('name', $city->name)->where('mst_pref_id',$arrDetailData['pref_id'])->first()->id;
                        $arrDetailData['city_id'] = $city_id ?? 0 ;
                    }

                    // state_id
                    $arrDetailData['state_id'] = 2;

                    // is_hellowork
                    $arrDetailData['is_hellowork'] = 4;
                    // is_set_search_item
                    $arrDetailData['is_set_search_item'] = 2;

                }

                if ($text === "最寄駅")
                {
                    $arrDetailData['access'] = str_replace("<br>", "\n", $texts[$count]);
                }  

                if ($text === "雇用形態")
                {
                    $arrDetailData['employment_type'] = str_replace("<br>", "\n", $texts[$count]);
                }  
                if ($text === "応募資格")
                {
                    $arrDetailData['requirement'] = str_replace("<br>", "\n", $texts[$count]);
                }  

            }

            dumps($arrDetailData);
 
        } catch (Exception $e) {
             $this->log_output($e);
             $arrDetailData['job_category'] = '';
        }
 
        if (
            isset($arrDetailData['job_category'])
            && !empty($arrDetailData['job_category'])
        ) {
            return $arrDetailData;
        } else {
            return false;
        }
    }
}
