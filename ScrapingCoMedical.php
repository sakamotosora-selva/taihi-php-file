<?php

namespace App\Library\Scraping;

use App\Facades\ConfigMaster;
use App\Model\ScrapingWork;

use Weidner\Goutte\GoutteFacade;
use Goutte\Client;
use App\Model\MstPref;
use App\Model\MstCity;
use Exception;
use App\Model\SearchItem;
use App\Model\SearchItemOption;
// use App\Model\FreeItem;
use Datetime;
use Log;
use DB;

/**
 * 
 * ファゲットのスクレイピングを行うクラス
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
class ScrapingCoMedical extends Scraping
{

    /**
     * コンストラクタ
     * @param string $strSiteId サイトID
     * @param Logger|null $log ロガー
     */
    function __construct($strSiteId, $log = null)
    {
        print "コメディカルのスクレイピングの処理を記述";
        // exit;

         // 取得先サイトのID
        $this->strSiteId            = $strSiteId;        

        // 取得先サイトのベースURL（URLの不可変部分）
        $this->strTargetUrlBase     = 'https://www.co-medical.com/apo/'; 

        // $this->strTargetUrl         = '/search?sort=recency';                         // 取得先サイトの初回アクセスURL（URLの可変部分）

        // 求人詳細ページURLリスト取得開始ページ
        $this->listStartPage        = $this->strTargetUrlBase . $this->strTargetUrl;  
        $this->pageItemNum          = 31;                                             // １ページあたりの表示件数

        // 取得先サービスのID・・・config('master.scraping_service')参照
        $this->strServiceId         = "CoMedical";                                        
        
        // ロガー
        $this->log                  = $log;                                           

        // 
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
        $list = GoutteFacade::request('GET', $this->strTargetUrlBase . $this->strTargetUrl);
        // $hitNum = array();
        // ページ数を取得
        $hitNum = $list->filter('.numberArea span')->text();

        $hitNum = preg_replace('/[^0-9]/', '', $hitNum);
        // $this->log_output($hitNum);
        $last_page = ceil($hitNum / $this->pageItemNum);

        $this->log_output("Total pages:" . $last_page . '(薬剤師)' . "\n");
        
        //全ての求人をスクレイピングする場合
        // for ($page = 1; $page <= $last_page; $page++) { //
        // for ($page = 1; $page <= 1; $page++) { //
        for ($page = 103; $page <= 103; $page++) { //
            $list = GoutteFacade::request('GET', $this->strTargetUrlBase . 'page/' . $page . '/');
            $list->filter('.button .txt > a')->each(function ($element) use (&$urls) {
                if (strpos($element->attr('href'), 'job'))
                {
                    // https://www.co-medical.com/apo/job数字　の形になるように変形
                    $urls[] = $this->strTargetUrlBase . str_replace('apo', '', str_replace('/apo/', '', $element->attr('href')));
                    // $this->log_output($this->strTargetUrlBase . str_replace('apo', '', str_replace('/apo/', '', $element->attr('href'))));
                }

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

            // 取得結果がnullでなければ
            if ($detailData) {
                $arrJobData[] = $detailData;
            } else {
                $count_NG++;
            }
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
            $arrDetailData['foreign_id'] = str_replace('https://www.co-medical.com/apo/job', '', $detailPageUrl);
                
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
            $arrDetailData['zip'] = $post->filter('.w70p')->text();
            // is_enable_daily_payment
            $arrDetailData['is_enabled_daily_payment'] = 2;
            // name (詳細ページの題名)
            $arrDetailData['name'] = str_replace("<br>", "\n", $post->filter('.prArea h1 > span')->text());

            // タグ
            $tags = [];

            $post->filter('.jobIcons li')->each(function ($table) use (&$tags) {
                $tags[] = $table->text();

            });

           $arrDetailData['search_item_option_ids_6'] = '';

           // search_item6_options:データベースにあらかじめ登録した全タグ名がコレクションで格納されている。
           if (isset($tags) && !is_null($this->search_item6_options)) {
               $item_option6_strings = $tags;
               $tmpArray = [];
               foreach($item_option6_strings as $item_option6_string) {
                   foreach($this->search_item6_options as $key => $search_item6_option) {
                       if ($search_item6_option == $item_option6_string) {
                           $tmpArray[] = $key;
                       }
                   }
               }
               $arrDetailData['search_item_option_ids_6'] = implode(',', array_unique($tmpArray));
            }

            // マッチングチャートの下にある文章
            $arrDetailData['pr_text'] = $post->filter('.pr')->text();

            //求人情報

            $texts = [];
            $table_tr = $post->filter('.requirementArea table tr th, .requirementArea table tr td');

            $table_tr->each(function ($table) use (&$texts) {
                $texts[] = $table->text();
            });

            // dd($texts);

            $count = 0;

            foreach ($texts as $text)
            {
                $count++;

                if ($text === "求人職種")
                {

                    $employment_type = str_replace("<br>", "\n", $texts[$count]);

                    if (strpos($employment_type, "薬剤師") !== false)
                    {
                        $employment_type = str_replace("薬剤師", "", $employment_type);




                        foreach ($this->search_item3_options as $key => $item3_string)
                        {
                            // $this->log_output($item3_string);
                            // $this->log_output($key);

                            if (strpos($employment_type, $item3_string) !== false) {
                                $keys[] = $key;
                            }

                        }
                        $arrDetailData['search_item_option_ids_2'] = implode(",", $keys);
                        // $this->log_output($result);

                    }

                    // dd("とめるる");
                }

                if ($text === "募集雇用形態")
                {
                    $arrDetailData['employment_type'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "仕事内容")
                {
                    $arrDetailData['job_detail'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "シフト")
                {
                    $arrDetailData['job_time'] = str_replace("<br>", "\n", $texts[$count]);

                }

                if (strpos($text, '給料例') === 0)
                {

                    $incomeText = $texts[$count];

                    $arrDetailData['income'] = $incomeText;

                    // $this->log_output($arrDetailData['income']);

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
                    // $this->log_output("以下、income");
                    // $this->log_output($income);

                    preg_match_all('/[0-9]+万[0-9]*/', $income,$income_matches);

                    foreach ($income_matches[0] as $income_text) {
                        $num_man = mb_strstr( $income_text, '万', true);
                        $num_yen = mb_strstr( $income_text, '万');
                        $num_yen = str_replace('万','',$num_yen);
                        $num = (int) $num_man *10000 + (int) $num_yen;
                        $income = str_replace($income_text,$num,$income);
                    }

                    // $this->log_output($income);


                    // 
                    preg_match_all('/(「|\[|【)?(年収|年俸|月給|⽉給|時給|月収|日給)(」|\]|】)?(:|：|…)?[0-9]+(～|〜|-)[0-9]+円/',$income,$not_exit_yen_match);
                    foreach ($not_exit_yen_match[0] as $income_text) {
                        $str = preg_replace('/(～|〜|-)/','～円',$income_text);
                        $income = str_replace($income_text,$str,$income);
                    }

                    // $this->log_output("以下、income3");
                    // $this->log_output($income);

                    // ここの処理で$matchの中身が空の配列を作成してしまうページがある。
                    // 共通している特徴としては 月給272,100～円など。
                    // https://www.co-medical.com/apo/job214288/

                    // 月給226,000～288,000円  
                    // https://www.co-medical.com/apo/job127894/
                    // 数値の次に〜がくる

                    preg_match('/(「|\[|【)?(年収|年俸|月給|⽉給|時給|月収|日給)(」|\]|】)?(:|：|…)?[0-9]+円(～|〜|-)?([0-9]+円)?/',$income,$match);

                    // dump($match);

                    $false_flg = false;

                    // 他のファイルの給与ロジックを使用して上手くいかなかったページの場合。
                    if (empty($match))
                    {
                        // $this->log_output("失敗した");
                        preg_match('/(「|\[|【)?(年収|年俸|月給|⽉給|時給|月収|日給)(」|\]|】)?(:|：|…)?[0-9]+(～|〜|-)?円([0-9]+円)?/',$income,$match);
                        // dump($match);

                        $false_flg = true;


                    } 
                    // else {
                    // }
                    $income = $match[0];

                    // $income = $match[0] ?? false;


                    // $this->log_output("かか" . $income);

                    // dd($income);
                    
                    if($income){
                        $regex = '/([0-9]+円)/';

                        if ($false_flg)
                        {
                            $regex = '/([0-9]+～)/';
                        }

                        preg_match_all($regex, $income, $matches);

                        // $this->log_output("いかmatches");
                        // dump($matches);

                        // $this->log_output("いかincome");
                        // dump($income);

                        if (strpos($income, '～円') != false)
                        {
                            $income = str_replace('円', '', $income);
                            // dump("かええ");
                        }
                        // dump($income);

                        //「~」がある場合
                        if (preg_match('/(～|〜|-)[0-9]/', $income)) {
                            $arrDetailData['income_min'] = preg_replace('/円/', '', $matches[0][0]);

                            // if (preg_match('/(～|〜|-)[0-9]/', ))
                            // dump($arrDetailData['income_min']);
                            // $this->log_output("じゃじゃじゃ");
                            $arrDetailData['income_max'] = !empty($matches[0][1]) ? preg_replace('/円/', '', $matches[0][1]) : NULL;
                            // dump($arrDetailData['income_max']);

                            // 例）〜288000円の部分を取得
                            $regex = '/(\d+)$/';
                            $matches2 = [];

                            // 月給226000～円288000円の形のような場合、nullが入るので
                            if (is_null($arrDetailData['income_max']) && preg_match($regex, $income, $matches2))
                            {
                                $arrDetailData['income_max'] = $matches2[0];
                            }

                        } elseif (preg_match('/～|〜|-/', $income)) {
                            $arrDetailData['income_min'] = preg_replace('/円/', '', $matches[0][0]);
                            $arrDetailData['income_max'] = NULL;
                            $this->log_output("じゃじゃじゃ2");

                        }else {
                            $arrDetailData['income_min'] = isset($matches[0][0]) ? preg_replace('/円/', '', $matches[0][0]): NULL;
                            $arrDetailData['income_max'] = isset($matches[0][0]) ? preg_replace('/円/', '', $matches[0][0]) : NULL;
                        }

                        // dd($arrDetailData['income_max']);

                        $regex = '/年収|年俸|月給|⽉給|時給|月収|日給/';
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
                        case '⽉給':
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

                        $kao = $arrDetailData['income_min'];

                        if (preg_match('/[^0-9]/', $kao) == 1)
                        {
                            $arrr = preg_replace('/[^0-9]/', '', $kao);

                            $arrDetailData['income_min'] = $arrr;
                        }

                    }

                    // 間違った情報が入らないようにフィルター
                    if ( !$this->check_income($arrDetailData['income_type'],$arrDetailData['income_min'],$arrDetailData['income_max']) ) {
                        $arrDetailData['income_max'] = null;
                        $arrDetailData['income_min'] = null;
                        $arrDetailData['income_type'] = null;
                    }
                }


                if ($text === "待遇・福利厚生")
                {
                    $arrDetailData['treatment'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "休日・休暇")
                {
                    $arrDetailData['holiday'] = str_replace("<br>", "\n", $texts[$count]);
                }

                
            }

            // 基本情報
            $texts = [];
            $table_tr = $post->filter('.profileArea table tr th , .profileArea table tr td');

            $count = 0;
            $table_tr->each(function ($table) use (&$texts) {
                $texts[] = $table->text();
            });


            foreach ($texts as $text)
            {
                $count++;

                if ($text === "事業所名")
                {
                    $arrDetailData['facility_name'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "施設形態")
                {
                    $arrDetailData['job_category'] = str_replace("<br>", "\n", $texts[$count]);
                    $gyoushu = $arrDetailData['job_category'];
                    // 業種（職種） search_item_option
                    $arrDetailData['search_item_option_ids_2'] = '';
                    if (isset($gyoushu) && !is_null($this->search_item2_options)) {
                        $item_option2_strings = explode(',', $gyoushu);
                        $tmpArray = [];
                        foreach($item_option2_strings as $item_option2_string) {
                            foreach($this->search_item2_options as $key => $search_item2_option) {
    
                                if ($search_item2_option == $item_option2_string) {
                                    $tmpArray[] = $key;
                                }
                            }
                        }
                        $arrDetailData['search_item_option_ids_2'] = implode(',', array_unique($tmpArray));
                    }

                    // dump($arrDetailData['job_category']);
                    // dd($arrDetailData['search_item_option_ids_2']);

                }

                if ($text === "所在地")
                {

                    // $this->log_output(str_replace("<br>", "\n", $texts[$count]));

                    $zip = substr($texts[$count], 3, 8); 

                    $arrDetailData['zip'] = $zip;

                    // 住所

                    // dumps($texts[$count]);

                    $regex = '/(東京都|北海道|(?:京都|大阪)府|.{6,9}県)((?:四日市|廿日市|野々市|臼杵|かすみがうら|つくばみらい|いちき串木野)市|(?:杵島郡大町|余市郡余市|高市郡高取)町|.{3,12}市.{3,12}区|.{3,9}区|.{3,15}市(?=.*市)|.{3,15}市|.{6,27}町(?=.*町)|.{6,27}町|.{9,24}村(?=.*村)|.{9,24}村)(.*)/';
                    preg_match($regex, $texts[$count], $matches);

                    // dumps($matches);

                    if (!empty($matches))
                    {
                        // これの意味
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

                        $sity = $matches[2];

                        $sity = preg_replace('/\s+/u', '', $sity);

                        // city_id
                        // $city = MstCity::where('name', $matches[2])->first();
                        $city = MstCity::where('name', $sity)->first();
                        // dd($city);
                        if ($city) {
                            $arrDetailData['city_id'] = $city->id;
                        } else {
                            $arrDetailData['city_id'] = 0;
                        }
                        $arrDetailData['address'] = $matches[3];

                        // $this->log_output($arrDetailData['address']);


                        if (strpos($arrDetailData['address'], "地図を表示"))
                        {
                            $arrDetailData['address'] = str_replace("地図を表示", "", $arrDetailData['address']);
                        }

                    } else {
                        $arrDetailData['pref_id'] = 0;
                        $arrDetailData['city_id'] = 0;
                        $arrDetailData['address'] = '';
                    }

                    // dd($arrDetailData['city_id']);

                    //市区町村のみ
                    $regex = '/((?:四日市|廿日市|野々市|臼杵|かすみがうら|つくばみらい|いちき串木野)市|(?:杵島郡大町|余市郡余市|高市郡高取)町|.{3,12}市.{3,12}区|.{3,9}区|.{3,15}市(?=.*市)|.{3,15}市|.{6,27}町(?=.*町)|.{6,27}町|.{9,24}村(?=.*村)|.{9,24}村)(.*)/';
                    preg_match($regex, $texts[$count], $matches);
                    // dd($matches[1]);
                    // dd($texts[$count]);
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

                    // dd($arrDetailData['city_id']);

                    // state_id
                    $arrDetailData['state_id'] = 2;

                    // dd($arrDetailData['state_id']);

                    // is_hellowork
                    $arrDetailData['is_hellowork'] = 4;
                    // is_set_search_item
                    $arrDetailData['is_set_search_item'] = 2;

                }

                if ($text === "最寄駅")
                {
                    $arrDetailData['access'] = str_replace("<br>", "\n", $texts[$count]);
                }

                if ($text === "交通アクセス")
                {
                    $arrDetailData['access'] = str_replace("<br>", "\n", $texts[$count]);
                }

            }
            // dump($arrDetailData['city_id']);
            // dumps($arrDetailData);


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
