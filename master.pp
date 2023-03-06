<?php

return [
    //新着情報の公開ステータス
    'is_draft' => array(
        '1' => array('value' => '1', 'name' => '公開'),
        '2' => array('value' => '2', 'name' => '下書き'),
    ),
    //アカウント管理者の有効無効ステータス
    'valid' => array(
        '1' => array('value' => '1', 'name' => '有効'),
        '2' => array('value' => '2', 'name' => '無効'),
    ),
    //同意
    'agree' => array(
        '1' => array('value' => '1', 'name' => '同意する'),
        // '2' => array('value' => '2', 'name' => '同意しない'),
    ),
    // 配偶者
    'spouse' => array(
        '1' => array('value' => '1', 'name' => 'あり'),
        '2' => array('value' => '2', 'name' => 'なし'),
    ),
    // 経験社数
    'eperienced_companys' => array(
        '1'  => array('value' => '1',  'name' => '0社'),
        '2'  => array('value' => '2',  'name' => '1社'),
        '3'  => array('value' => '3',  'name' => '2社'),
        '4'  => array('value' => '4',  'name' => '3社'),
        '5'  => array('value' => '5',  'name' => '4社'),
        '6'  => array('value' => '6',  'name' => '5社'),
        '7'  => array('value' => '7',  'name' => '6社'),
        '8'  => array('value' => '8',  'name' => '7社'),
        '9'  => array('value' => '9',  'name' => '8社'),
        '10' => array('value' => '10', 'name' => '9社'),
        '11' => array('value' => '11', 'name' => '10社'),
        '12' => array('value' => '12', 'name' => '11社以上'),
    ),
    // 業種
    // 'industry' => array(
    //     '1'  => array('value' => '1',  'name' => '0社'),
    //     '2'  => array('value' => '2',  'name' => '1社'),
    //     '3'  => array('value' => '3',  'name' => '2社'),
    //     '4'  => array('value' => '4',  'name' => '3社'),
    //     '5'  => array('value' => '5',  'name' => '4社'),
    //     '6'  => array('value' => '6',  'name' => '5社'),
    //     '7'  => array('value' => '7',  'name' => '6社'),
    //     '8'  => array('value' => '8',  'name' => '7社'),
    //     '9'  => array('value' => '9',  'name' => '8社'),
    //     '10' => array('value' => '10', 'name' => '9社'),
    //     '11' => array('value' => '11', 'name' => '10社'),
    //     '12' => array('value' => '12', 'name' => '11社以上'),
    // ),
    // 求人情報の表示ステータス
    'show_valid' => array(
        '1' => array('value' => '1', 'name' => '表示'),
        '2' => array('value' => '2', 'name' => '非表示'),
    ),
    //新着情報の掲載ステータス
    'public_status' => array(
        '1' => array('value' => '1', 'name' => '掲載待ち'),
        '2' => array('value' => '2', 'name' => '掲載中'),
        '3' => array('value' => '3', 'name' => '掲載終了'),
        '4' => array('value' => '4', 'name' => '非公開'),
    ),
    //支部
    'kind' => array(
        '1' => array('value' => '1', 'name' => '本部'),
        '2' => array('value' => '2', 'name' => '支部'),
    ),
    //動画種類
    'album_kind' => array(
        '1' => array('value' => '1', 'name' => '動画'),
        '2' => array('value' => '2', 'name' => '画像'),
    ),
    'blog_class' => array(
        '1' => array('value' => '1', 'name' => '一般向け'),
        '2' => array('value' => '2', 'name' => '会員向け'),
    ),
    'headquarters' => array(
        'm_area_id'   => 1,
        'm_area_name' => '本部',
        'branch_num'   => 1,
        's_area_list' => array(
            0 => array(
                'm_s_area_name' => '',
                'branch_list'   => array(
                    0 => array(
                        'branch_id'   => 0,
                        'branch_name' => '本部',
                    )
                ),
            )
        ),
    ),
    'headquarters2' => array(
        array('value' => 0, 'name' => '本部'),
    ),
    //性別
    'gender' => array(
        '1' => array('value' => '1', 'name' => '男性'),
        '2' => array('value' => '2', 'name' => '女性'),
    ),
    //職業
    'job' => array(
        '1' => array('value' => '1', 'name' => '学生'),
        '2' => array('value' => '2', 'name' => '会社員'),
        '3' => array('value' => '3', 'name' => '公務員'),
        '4' => array('value' => '4', 'name' => '主婦'),
        '5' => array('value' => '5', 'name' => '自営業'),
        '6' => array('value' => '6', 'name' => 'その他'),
    ),
    //現在の職業
    'current_job' => array(
        '1' => array('value' => '1', 'name' => '学生'),
        '2' => array('value' => '2', 'name' => '会社員'),
        '3' => array('value' => '3', 'name' => '公務員'),
        '4' => array('value' => '4', 'name' => '主婦'),
        '5' => array('value' => '5', 'name' => '自営業'),
        '6' => array('value' => '6', 'name' => 'その他'),
    ),
    //学校
    'class' => array(
        '1' => array('value' => '1', 'name' => '大学'),
        '2' => array('value' => '2', 'name' => '短期大学'),
        '3' => array('value' => '3', 'name' => '大学院(修士)'),
        '4' => array('value' => '4', 'name' => '大学院(博士)'),
        '5' => array('value' => '5', 'name' => '専門学校'),
        '6' => array('value' => '6', 'name' => '高等学校'),
        '7' => array('value' => '7', 'name' => '中学校'),
        '8' => array('value' => '8', 'name' => 'その他'),
    ),
    //学部
    'faculty' => array(
        '1' => array('value' => '1', 'name' => '文学系'),
        '2' => array('value' => '2', 'name' => '語学(英語系)'),
        '3' => array('value' => '3', 'name' => '語学(英語以外)'),
        '4' => array('value' => '4', 'name' => '教育系'),
        '5' => array('value' => '5', 'name' => '経済・経営・管理系'),
        '6' => array('value' => '6', 'name' => '法律系'),
        '7' => array('value' => '7', 'name' => 'その他文系'),
        '8' => array('value' => '8', 'name' => '化学系'),
        '9' => array('value' => '9', 'name' => '機械系'),
        '10' => array('value' => '10', 'name' => '財務・会計系'),
        '11' => array('value' => '11', 'name' => '情報・プログラム系'),
        '12' => array('value' => '12', 'name' => 'システム設計・分析系'),
        '13' => array('value' => '13', 'name' => '数学・物理系'),
        '14' => array('value' => '14', 'name' => '生物・農学系'),
        '15' => array('value' => '15', 'name' => '材料・資源・金属系'),
        '16' => array('value' => '16', 'name' => '電気・電子系'),
        '17' => array('value' => '17', 'name' => '土木・建築系'),
        '18' => array('value' => '18', 'name' => 'ハード設計系'),
        '19' => array('value' => '19', 'name' => 'その他理系'),
        '20' => array('value' => '20', 'name' => '医学・薬学系'),
        '21' => array('value' => '21', 'name' => '福祉・看護系'),
        '22' => array('value' => '22', 'name' => '芸術系'),
        '23' => array('value' => '23', 'name' => 'その他'),
    ),
    //興味のあること
    'interest' => array(
        '1' => array('value' => '1', 'name' => '政治'),
        '2' => array('value' => '2', 'name' => '経済'),
        '3' => array('value' => '3', 'name' => 'スポーツ'),
        '4' => array('value' => '4', 'name' => '旅行'),
        '5' => array('value' => '5', 'name' => 'ファッション'),
        '6' => array('value' => '6', 'name' => '映画'),
        '7' => array('value' => '7', 'name' => '教育'),
    ),
    //銀行口座種類
    'bank_account_type' => array(
        '1' => array('value' => '1', 'name' => '普通'),
        '2' => array('value' => '2', 'name' => '当座'),
        '3' => array('value' => '3', 'name' => 'その他'),
    ),
    'administer_authority' => array(
        '1' => array('value' => '1', 'name' => '本部管理者'   , 'authority' => 'is_admin' ),
        '2' => array('value' => '2', 'name' => 'サイト管理者' , 'authority' => 'is_general'),
        '3' => array('value' => '3', 'name' => '企業'        , 'authority' => 'is_company'),
    ),
    //問い合わせ種類
    'contact_category' => array(
        '1' => array('value' => '1', 'name' => '商品について'),
        '2' => array('value' => '2', 'name' => 'サイトについて'),
        '3' => array('value' => '3', 'name' => '見積依頼'),
        '4' => array('value' => '4', 'name' => 'その他'),
    ),
    // 求人情報の掲載状態
    'post_state' => array(
        '1' => array('value' => '1', 'name' => '掲載待ち'),
        '2' => array('value' => '2', 'name' => '掲載中'),
        '3' => array('value' => '3', 'name' => '掲載終了'),
        '4' => array('value' => '4', 'name' => '非公開'),
    ),
    // 求人情報の掲載プラン
    'plan' => array(
        '1' => array('value' => '1', 'name' => '上位プラン'),
        '2' => array('value' => '2', 'name' => '中位プラン'),
        '3' => array('value' => '3', 'name' => '下位プラン'),
        '4' => array('value' => '4', 'name' => '下位プラン （募集終了）'),
    ),
    // 求人情報の表示優先度
    'sort_setting' => array(
        '1' => array('value' => '1', 'name' => 'プランに準ずる'),
        '2' => array('value' => '2', 'name' => '右記に変更する'),
    ),
    // 求人情報 職種
    'job_category' => array(
        '1' => array('value' => '1', 'name' => '調剤薬局'),
        '2' => array('value' => '2', 'name' => '調剤薬局・OTC販売'),
        '3' => array('value' => '3', 'name' => 'OTC販売'),
        '4' => array('value' => '4', 'name' => '病院'),
        '5' => array('value' => '5', 'name' => 'その他'),
    ),
    // 求人情報 職種
    // （ConfigMaster::getSelectName('job_category', $id）でjob_categoryの値を取得しようとすると、
    // job_category_hwの値を取得してしまうので別名で複製
    'category' => array(
        '1' => array('value' => '1', 'name' => '調剤薬局'),
        '2' => array('value' => '2', 'name' => '調剤薬局・OTC販売'),
        '3' => array('value' => '3', 'name' => 'OTC販売'),
        '4' => array('value' => '4', 'name' => '病院'),
        '14' => array('value' => '14', 'name' => 'その他'),
    ),
    // 求人情報 職種 （ハローワーク）
    'job_category_hw' => array(
        '1' => array('value' => '1', 'name' => '調剤'),
        '2' => array('value' => '2', 'name' => '医薬品販売'),
        '3' => array('value' => '3', 'name' => 'その他'),
    ),
    // 求人情報 雇用形態
    'employment_type' => array(
        '1' => array('value' => '1', 'name' => '正社員'),
        '2' => array('value' => '2', 'name' => '契約社員'),
        '3' => array('value' => '3', 'name' => '派遣社員'),
        '4' => array('value' => '4', 'name' => 'パート・アルバイト'),
        '5' => array('value' => '5', 'name' => 'インターン'),
        '6' => array('value' => '6', 'name' => 'その他'),
    ),
    // 求人情報 雇用形態
    'employment_type_hw' => array(
        '1' => array('value' => '1', 'name' => '正社員'),
        '2' => array('value' => '2', 'name' => 'パート'),
    ),
    // GFJ用 求人情報 雇用形態
    'gfj_employment_type' => array(
        '1' => array('value' => '1', 'name' => 'FULL_TIME'),
        '2' => array('value' => '2', 'name' => 'CONTRACTOR'),
        '3' => array('value' => '3', 'name' => 'TEMPORARY'),
        '4' => array('value' => '4', 'name' => 'PART_TIME'),
        '5' => array('value' => '5', 'name' => 'INTERN'),
        '6' => array('value' => '6', 'name' => 'OTHER'),
    ),
    // 検索3 雇用形態の初期値
    'employment_type_default' => array(
        '1'  => array('value' => '1', 'name' => '正社員'),
        '2'  => array('value' => '2', 'name' => '契約社員'),
        '3'  => array('value' => '3', 'name' => '派遣社員'),
        '4'  => array('value' => '4', 'name' => 'パート・アルバイト'),
        '5'  => array('value' => '5', 'name' => 'インターン'),
        '6'  => array('value' => '6', 'name' => '紹介予定派遣'),
        '7'  => array('value' => '7', 'name' => '職業紹介'),
        '8'  => array('value' => '8', 'name' => '業務委託'),
        '9'  => array('value' => '9', 'name' => 'フリーランス'),
        '10' => array('value' => '10', 'name' => 'その他'),
    ),
    // 求人情報 PRテキスト
    'pr_option' => array(
        '1' => array('value' => '1', 'name' => '未経験者歓迎'),
        '2' => array('value' => '2', 'name' => '経験者優遇'),
        '3' => array('value' => '3', 'name' => 'ブランク可'),
        '4' => array('value' => '4', 'name' => '年齢不問'),
        '5' => array('value' => '5', 'name' => '新卒可'),
        '6' => array('value' => '6', 'name' => '中高齢者OK'),
        '7' => array('value' => '7', 'name' => '午前のみ勤務'),
        '8' => array('value' => '8', 'name' => '午後のみ勤務'),
        '9' => array('value' => '9', 'name' => '日曜休み'),
        '10' => array('value' => '10', 'name' => '土日休み'),
        '11' => array('value' => '11', 'name' => '残業ほぼなし'),
        '12' => array('value' => '12', 'name' => '日勤のみ可'),
        '13' => array('value' => '13', 'name' => '夜勤なし'),
        '14' => array('value' => '14', 'name' => '短時間勤務'),
        '15' => array('value' => '15', 'name' => '夜勤専従あり'),
        '16' => array('value' => '16', 'name' => '4週8休以上'),
        '17' => array('value' => '17', 'name' => '年間休日120日以上'),
        '18' => array('value' => '18', 'name' => '駅近(5分以内)'),
        '19' => array('value' => '19', 'name' => '車通勤可'),
        '20' => array('value' => '20', 'name' => '寮あり・社宅あり'),
        '21' => array('value' => '21', 'name' => '託児所・保育支援あり'),
        '22' => array('value' => '22', 'name' => 'ボーナスあり'),
        '23' => array('value' => '23', 'name' => '退職金あり'),
        '24' => array('value' => '24', 'name' => '扶養範囲内勤務OK'),
        '25' => array('value' => '25', 'name' => '復職支援'),
        '26' => array('value' => '26', 'name' => '研修制度あり'),
        '27' => array('value' => '27', 'name' => '勉強会あり'),
        '28' => array('value' => '28', 'name' => '30代活躍中'),
        '29' => array('value' => '29', 'name' => 'アットホーム'),
        '30' => array('value' => '30', 'name' => '子育て中ママ活躍'),
        '31' => array('value' => '31', 'name' => 'WワークOK'),
        '32' => array('value' => '32', 'name' => '新規オープン'),
    ),
    // 求人情報 給与支払いタイプ(radio)
    'income_type' => array(
        '1' => array('value' => '1', 'name' => '年収'),
        '2' => array('value' => '2', 'name' => '月給'),
        '3' => array('value' => '3', 'name' => '日給'),
        '4' => array('value' => '4', 'name' => '時給'),
    ),
    // 企業情報の掲載プラン
    'company_plan' => array(
        '1' => array('value' => '1', 'name' => '上位プラン'),
        '2' => array('value' => '2', 'name' => '中位プラン'),
        '3' => array('value' => '3', 'name' => '下位プラン'),
    ),
    // 直近の年収
    'annual_income' => array(
        '1' => array('value' => '1', 'name' => '199万円以下'),
        '2' => array('value' => '2', 'name' => '200～249万円'),
        '3' => array('value' => '3', 'name' => '250～299万円'),
        '4' => array('value' => '4', 'name' => '300～349万円'),
        '5' => array('value' => '5', 'name' => '350～399万円'),
        '6' => array('value' => '6', 'name' => '400～449万円'),
        '7' => array('value' => '7', 'name' => '500～549万円'),
        '8' => array('value' => '8', 'name' => '550～599万円'),
        '9' => array('value' => '9', 'name' => '600～649万円'),
        '10' => array('value' => '10', 'name' => '650～699万円'),
        '11' => array('value' => '11', 'name' => '700～799万円'),
        '12' => array('value' => '12', 'name' => '800～899万円'),
        '13' => array('value' => '13', 'name' => '900～999万円'),
        '14' => array('value' => '14', 'name' => '1000～1099万円'),
        '15' => array('value' => '15', 'name' => '1100～1199万円'),
        '16' => array('value' => '16', 'name' => '1200～1299万円'),
        '17' => array('value' => '17', 'name' => '1300～1399万円'),
        '18' => array('value' => '18', 'name' => '1400～1499万円'),
        '19' => array('value' => '19', 'name' => '1500万円以上'),
    ),
    // 年収
    'annual_income_tool' => array(
        '1' => array('value' => '1', 'name' => '150万円' , 'amount' => '1500000'),
        '2' => array('value' => '2', 'name' => '200万円','amount' => '2000000'),
        '3' => array('value' => '3', 'name' => '250万円','amount' => '2500000'),
        '4' => array('value' => '4', 'name' => '300万円','amount' => '3000000'),
        '5' => array('value' => '5', 'name' => '350万円','amount' => '3500000'),
        '6' => array('value' => '6', 'name' => '400万円','amount' => '4000000'),
        '7' => array('value' => '7', 'name' => '450万円','amount' => '4500000'),
        '8' => array('value' => '8', 'name' => '500万円','amount' => '5000000'),
        '9' => array('value' => '9', 'name' => '550万円','amount' => '5500000'),
        '10' => array('value' => '10', 'name' => '600万円','amount' => '6000000'),
        '11' => array('value' => '11', 'name' => '650万円','amount' => '6500000'),
        '12' => array('value' => '12', 'name' => '700万円','amount' => '7000000'),
        '13' => array('value' => '13', 'name' => '800万円','amount' => '8000000'),
        '14' => array('value' => '14', 'name' => '900万円','amount' => '9000000'),
        '15' => array('value' => '15', 'name' => '1000万円','amount' => '10000000'),
        '16' => array('value' => '16', 'name' => '1100万円','amount' => '11000000'),
        '17' => array('value' => '17', 'name' => '1200万円','amount' => '12000000'),
        '18' => array('value' => '18', 'name' => '1300万円','amount' => '13000000'),
        '19' => array('value' => '19', 'name' => '1400万円','amount' => '14000000'),
        '20' => array('value' => '20', 'name' => '1500万円','amount' => '15000000'),
    ),
    // 月収
    'monthly_income' => array(
        // '1' => array('value' => '1', 'name' => '9万円以下','amount' => '90000'),
        '2' => array('value' => '2', 'name' => '10万円','amount' => '100000'),
        '3' => array('value' => '3', 'name' => '20万円','amount' => '200000'),
        '4' => array('value' => '4', 'name' => '30万円','amount' => '300000'),
        '5' => array('value' => '5', 'name' => '40万円','amount' => '400000'),
        '6' => array('value' => '6', 'name' => '50万円','amount' => '500000'),
        '7' => array('value' => '7', 'name' => '60万円','amount' => '600000'),
        '8' => array('value' => '8', 'name' => '70万円','amount' => '700000'),
        '9' => array('value' => '9', 'name' => '80万円','amount' => '800000'),
        '10' => array('value' => '10', 'name' => '90万円','amount' => '900000'),
        '11' => array('value' => '11', 'name' => '100万円','amount' => '1000000'),
    ),
    // 日収
    'dayly_income' => array(
        '1' => array('value' => '1', 'name' => '3000円','amount' => '3000'),
        '2' => array('value' => '2', 'name' => '6500円','amount' => '6500'),
        '3' => array('value' => '3', 'name' => '7000円','amount' => '7000'),
        '4' => array('value' => '4', 'name' => '8000円','amount' => '8000'),
        '5' => array('value' => '5', 'name' => '8500円','amount' => '8500'),
        '6' => array('value' => '6', 'name' => '9000円','amount' => '9000'),
        '7' => array('value' => '7', 'name' => '9500円','amount' => '9500'),
        '8' => array('value' => '8', 'name' => '10000円','amount' => '10000'),
        '9' => array('value' => '9', 'name' => '11000円','amount' => '11000'),
        '10' => array('value' => '10', 'name' => '12000円','amount' => '12000'),
        '11' => array('value' => '11', 'name' => '15000円','amount' => '15000'),
        '12' => array('value' => '12', 'name' => '20000円','amount' => '20000'),
    ),
    // 時給
    'hourly_income' => array(
        // '1' => array('value' => '1', 'name' => '700円','amount' => '0'),
        '2' => array('value' => '2', 'name' => '700円','amount' => '700'),
        '3' => array('value' => '3', 'name' => '750円','amount' => '750'),
        '4' => array('value' => '4', 'name' => '800円','amount' => '800'),
        '5' => array('value' => '5', 'name' => '850円','amount' => '850'),
        '6' => array('value' => '6', 'name' => '900円','amount' => '900'),
        '7' => array('value' => '7', 'name' => '950円','amount' => '950'),
        '8' => array('value' => '8', 'name' => '1000円','amount' => '1000'),
        '9' => array('value' => '9', 'name' => ' 1050円','amount' => '1050'),
        '10' => array('value' => '10', 'name' => '1100円','amount' => '1100'),
        '11' => array('value' => '11', 'name' => '1150円','amount' => '1150'),
        '12' => array('value' => '12', 'name' => '1200円','amount' => '1200'),
        '13' => array('value' => '13', 'name' => '1250円','amount' => '1250'),
        '14' => array('value' => '14', 'name' => '1300円','amount' => '1300'),
        '15' => array('value' => '15', 'name' => '1400円','amount' => '1400'),
        '16' => array('value' => '16', 'name' => '1500円','amount' => '1500'),
        '17' => array('value' => '17', 'name' => '2000円','amount' => '2000'),
        '18' => array('value' => '18', 'name' => '2500円','amount' => '2500'),
        '19' => array('value' => '19', 'name' => '3000円','amount' => '3000'),
    ),
    // エリア：mst_city.idをvalueに設定しています
    'area' => array(
        '1' => array('value' => '28101', 'name' => '神戸市東灘区'),
        '2' => array('value' => '28102', 'name' => '神戸市灘区'),
        '3' => array('value' => '28110', 'name' => '神戸市中央区'),
        '4' => array('value' => '28105', 'name' => '神戸市兵庫区'),
        '5' => array('value' => '28106', 'name' => '神戸市長田区'),
        '6' => array('value' => '28107', 'name' => '神戸市須磨区'),
        '7' => array('value' => '28108', 'name' => '神戸市垂水区'),
        '8' => array('value' => '28109', 'name' => '神戸市北区'),
        '9' => array('value' => '28111', 'name' => '神戸市西区'),
        '10' => array('value' => '28206', 'name' => '芦屋市'),
        '11' => array('value' => '28203', 'name' => '明石市'),
        '12' => array('value' => '28210', 'name' => '加古川市'),
        '13' => array('value' => '28201', 'name' => '姫路市'),
        '14' => array('value' => '99999', 'name' => 'その他'),
    ),

    //都道府県
    'pref' => array(
       '1' => array('value' => '1', 'name' => 'hokkaidou'),
       '2' => array('value' => '2', 'name' => 'aomori'),
       '3' => array('value' => '3', 'name' => 'iwate'),
       '4' => array('value' => '4', 'name' => 'miyagi'),
       '5' => array('value' => '5', 'name' => 'akita'),
       '6' => array('value' => '6', 'name' => 'yamagata'),
       '7' => array('value' => '7', 'name' => 'fukushima'),
       '8' => array('value' => '8', 'name' => 'ibaraki'),
       '9' => array('value' => '9', 'name' => 'tochigi'),
       '10' => array('value' => '10', 'name' => 'gunma'),
       '11' => array('value' => '11', 'name' => 'saitama'),
       '12' => array('value' => '12', 'name' => 'chiba'),
       '13' => array('value' => '13', 'name' => 'tokyo'),
       '14' => array('value' => '14', 'name' => 'kanagawa'),
       '15' => array('value' => '15', 'name' => 'niigata'),
       '16' => array('value' => '16', 'name' => 'toyama'),
       '17' => array('value' => '17', 'name' => 'ishikawa'),
       '18' => array('value' => '18', 'name' => 'fukui'),
       '19' => array('value' => '19', 'name' => 'yamanashi'),
       '20' => array('value' => '20', 'name' => 'nagano'),
       '21' => array('value' => '21', 'name' => 'gifu'),
       '22' => array('value' => '22', 'name' => 'shizuoka'),
       '23' => array('value' => '23', 'name' => 'aichi'),
       '24' => array('value' => '24', 'name' => 'mie'),
       '25' => array('value' => '25', 'name' => 'shiga'),
       '26' => array('value' => '26', 'name' => 'kyoto'),
       '27' => array('value' => '27', 'name' => 'osaka'),
       '28' => array('value' => '28', 'name' => 'hyogo'),
       '29' => array('value' => '29', 'name' => 'nara'),
       '30' => array('value' => '30', 'name' => 'wakayama'),
       '31' => array('value' => '31', 'name' => 'tottori'),
       '32' => array('value' => '32', 'name' => 'shimane'),
       '33' => array('value' => '33', 'name' => 'okayama'),
       '34' => array('value' => '34', 'name' => 'hiroshima'),
       '35' => array('value' => '35', 'name' => 'yamaguchi'),
       '36' => array('value' => '36', 'name' => 'tokushima'),
       '37' => array('value' => '37', 'name' => 'kagawa'),
       '38' => array('value' => '38', 'name' => 'ehime'),
       '39' => array('value' => '39', 'name' => 'kochi'),
       '40' => array('value' => '40', 'name' => 'fukuoka'),
       '41' => array('value' => '41', 'name' => 'saga'),
       '42' => array('value' => '42', 'name' => 'nagasaki'),
       '43' => array('value' => '43', 'name' => 'kumamoto'),
       '44' => array('value' => '44', 'name' => 'oita'),
       '45' => array('value' => '45', 'name' => 'miyazaki'),
       '46' => array('value' => '46', 'name' => 'kagoshima'),
       '47' => array('value' => '47', 'name' => 'okinawa'),
    ),

    // 求人情報 ハローワークからの転載
    'hellowork' => array(
        '1' => array('value' => '2', 'name' => '転載ではない'),
        '2' => array('value' => '1', 'name' => 'ハローワークからの転載'),
        '3' => array('value' => '3', 'name' => '他サイトから引用（自サイト内で応募させる）'),
        '4' => array('value' => '4', 'name' => '他サイトから引用（引用元ＵＲＬへリンクする）'),
    ),

    // 求人情報 成果判定
    'result' => array(
        '1' => array('value' => '1', 'name' => '未確認'),
        '2' => array('value' => '2', 'name' => '判定中'),
        '3' => array('value' => '3', 'name' => '成果'),
        '4' => array('value' => '4', 'name' => '非成果'),
    ),

    // 求人情報 成果判定の色
    'result_color' => array(
        '1' => array('value' => '1', 'name' => 'red'),
        '2' => array('value' => '2', 'name' => 'purple'),
        '3' => array('value' => '3', 'name' => 'blue'),
        '4' => array('value' => '4', 'name' => 'black'),
    ),

    // 基本設定 フッターリンク タイプ
    'footer_type' => array(
        '1' => array('value' => '1', 'name' => '本文を設定する'),
        '2' => array('value' => '2', 'name' => '他ページへリンクする（同一ウインドウ）'),
        '3' => array('value' => '3', 'name' => '他ページへリンクする（別ウインドウ）'),
    ),

    // 使用有無
    'is_used' => array(
        '2' => array('value' => '2', 'name' => '使用しない'),
        '1' => array('value' => '1', 'name' => '使用する'),
    ),
     // 通知許可
     'is_notified' => array(
        '2' => array('value' => '2', 'name' => '許可しない'),
        '1' => array('value' => '1', 'name' => '許可する'),
    ),
    // 承認必要の有無
    'is_recruitment_approve' => array(
        '2' => array('value' => '2', 'name' => '不要'),
        '1' => array('value' => '1', 'name' => '必要'),
    ),
    // 必須/任意
    'is_required' => array(
        '1' => array('value' => '1', 'name' => '必須'),
        '2' => array('value' => '2', 'name' => '任意'),
    ),
    // 可否
    'is_enabled' => array(
        '1' => array('value' => '1', 'name' => '可能'),
        '2' => array('value' => '2', 'name' => '不可能'),
    ),
    // 表示/非表示
    'is_shown' => array(
        '1' => array('value' => '1', 'name' => '表示する'),
        '2' => array('value' => '2', 'name' => '表示しない'),
    ),
    // 有効/無効
    'is_valid' => array(
        '1' => array('value' => '1', 'name' => '有効'),
        '2' => array('value' => '2', 'name' => '無効'),
    ),
    // 出力有無
    'can_output' => [
        '1' => array('value' => '1', 'name' => '出力する'),
        '2' => array('value' => '2', 'name' => '出力しない'),
    ],
    
    // 対象の都道府県
    'search_pref' => array(
        '1' => array('value' => '1', 'name' => '全都道府県'),
        '2' => array('value' => '2', 'name' => '以下で選択した都道府県'),
    ),

    // 取得しない/取得する
    'data_get' => array(
        '1' => array('value' => '2', 'name' => '取得しない'),
        '2' => array('value' => '1', 'name' => '取得する'),
    ),

    // 曜日
    'week' => array(
        '1' => array('value' => '1', 'name' => '日'),
        '2' => array('value' => '2', 'name' => '月'),
        '3' => array('value' => '3', 'name' => '火'),
        '4' => array('value' => '4', 'name' => '水'),
        '5' => array('value' => '5', 'name' => '木'),
        '6' => array('value' => '6', 'name' => '金'),
        '7' => array('value' => '7', 'name' => '土'),
    ),

    // 設定しない/設定する
    'is_setting' => array(
        '1' => array('value' => '2', 'name' => '設定しない'),
        '2' => array('value' => '1', 'name' => '設定する'),
    ),

    // 標準デザイン/オリジナルデザイン
    'original_design' => array(
        '1' => array('value' => '2', 'name' => '標準デザイン'),
        '2' => array('value' => '1', 'name' => 'オリジナルデザイン'),
    ),

    // 表示する件数
    'per_page' => array(
        '1' => array('value' => '10', 'name' => '10件'),
        '2' => array('value' => '20', 'name' => '20件'),
    ),

    // 標準文言/オリジナル文言
    'original_meta' => array(
        '1' => array('value' => '1', 'name' => '標準文言'),
        '2' => array('value' => '2', 'name' => 'オリジナル文言'),
    ),

    // 職種名表示形式
    'job_display_type' => [
        '1' => array('value' => '1', 'name' => '職種名'),
        '2' => array('value' => '2', 'name' => '職種名（職種 ※検索用）'),
        '3' => array('value' => '3', 'name' => '任意設定(職種名) '),
    ],

    // 設置範囲（フォームの質問）
    'valid_entry_type' => array(
        '1' => array('value' => '1', 'name' => '応募＋相談'),
        '2' => array('value' => '2', 'name' => '応募'),
        '3' => array('value' => '3', 'name' => '相談'),
    ),

    // 回答形式
    'answer_format' => array(
        '1' => array('value' => '1', 'name' => '択一選択（ラジオボタン）'),
        '6' => array('value' => '6', 'name' => '択一選択（プルダウン）'),
        '2' => array('value' => '2', 'name' => '複数選択'),
        '3' => array('value' => '3', 'name' => 'テキスト'),
        '4' => array('value' => '4', 'name' => 'テキストエリア'),
        '5' => array('value' => '5', 'name' => '添付ファイル（ファイル形式：PDF/ワード/エクセル）'),
    ),

    // お気に入り登録ボタンラベル
    'btn_Favorite' => array(
        '1' => array('value' => '1', 'name' => 'お気に入り'),
        '2' => array('value' => '2', 'name' => 'お気に入り解除'),
    ),

    // CSVインポート時データ更新方法
    'csv_update_method' => [
        '1' => ['value' => '1', 'name' => '追加のみ'],
        '2' => ['value' => '2', 'name' => '追加＋既存情報の更新　※「求人情報ID」をキーとする'],
        '3' => ['value' => '3', 'name' => '追加＋既存情報の更新　※「識別用ID」をキーとする'],
    ],

    // 検索項目名表示有無
    'is_tag_shown' => [
        '1' => array('value' => '1', 'name' => '表示しない'),
        '2' => array('value' => '2', 'name' => '選択したものを表示する'),
        '3' => array('value' => '3', 'name' => '全て表示する'),
    ],

    // 「条件選択から探す」表示有無
    'is_frontsearch_shown' => [
        '1' => array('value' => '2', 'name' => '表示しない'),
        '2' => array('value' => '1', 'name' => '表示する'),
    ],

    // 求人詳細 表示するID
    'show_id_type' => [
        '1' => array('value' => '1', 'name' => '求人ID'),
        '2' => array('value' => '2', 'name' => '識別用ID'),
    ],

    // ブログ「本文」エディタ利用有無
    'editor' => [
        '1' => array('value' => '1', 'name' => 'エディタを利用する'),
        '2' => array('value' => '2', 'name' => 'エディタを利用しない'),
    ],

    // トップページメイン画像部分 検索項目の表示形式
    'top_main_search_type' => [
        '1' => array('value' => '1', 'name' => ''),
        '2' => array('value' => '2', 'name' => '「フリーワード」のみ'),
        '3' => array('value' => '3', 'name' => '相談フォームを表示'),
        '4' => array('value' => '4', 'name' => '何も表示しない'),
    ],

    // 左カラム検索項目の表示形式
    'top_left_search_type' => [
        '1' => array('value' => '1', 'name' => ''),
        '2' => array('value' => '2', 'name' => '「フリーワード」のみ'),
    ],

    // メルマガ 配信状況
    'melmaga_status' => array(
        '1' => array('value' => '1', 'name' => '予約中'),
        '2' => array('value' => '2', 'name' => '送信中'),
        '3' => array('value' => '3', 'name' => '送信完了'),
    ),

    // 済/未
    'finished_not_finished' => array(
        '1' => array('value' => '1', 'name' => '済'),
        '2' => array('value' => '2', 'name' => '未'),
    ),

    // 検索項目の表示形式
    'aggregate_site' => [
        '1'  => array('value' => '1', 'id' => '1', 'name' => 'テックゲート', 'host_name' => 'tecgate.jp'),
        '2'  => array('value' => '2', 'id' => '2', 'name' => 'セルワーク 保育士求人', 'host_name' => 'hoiku.selwork.jp'),
        '3'  => array('value' => '3', 'id' => '3', 'name' => 'セルワーク 看護師求人', 'host_name' => 'kango.selwork.jp'),
        '4'  => array('value' => '4', 'id' => '4', 'name' => 'セルワーク 介護士求人', 'host_name' => 'kaigo.selwork.jp'),
        '5'  => array('value' => '5', 'id' => '5', 'name' => 'セルワーク ＭＲ求人', 'host_name' => 'mr.selwork.jp'),
        '6'  => array('value' => '6', 'id' => '6', 'name' => 'セルワーク 薬剤師求人', 'host_name' => 'pharma.selwork.jp'),
        '7'  => array('value' => '7', 'id' => '7', 'name' => 'セルワーク 飲食求人', 'host_name' => 'gourmet.selwork.jp'),
        '8'  => array('value' => '8', 'id' => '8', 'name' => 'セルワーク キャバクラ求人', 'host_name' => 'night.selwork.jp'),
        '9'  => array('value' => '9', 'id' => '9', 'name' => 'セルワーク 美容師求人', 'host_name' => 'salon.selwork.jp'),
        '10' => array('value' => '10', 'id' => '10', 'name' => 'セルワーク 調理師・栄養士求人', 'host_name' => 'cooks.selwork.jp'),
        '11' => array('value' => '11', 'id' => '11', 'name' => 'セルワーク 建築求人', 'host_name' => 'kenchiku.selwork.jp'),
    ],

    // 非公開求人の紹介を行うサイト
    'undisclosed_recommend_sites' => [
        '1'  => 'hoiku.selva-i.co.jp',
        '2'  => 'kango.selva-i.co.jp',
        '3'  => 'kaigo.selva-i.co.jp',
        '4'  => 'phama.selva-i.co.jp',
        '5'  => 'salon.selva-i.co.jp',
        '6'  => 'cooks.selva-i.co.jp',
        '7'  => 'kenchiku.selva-i.co.jp',
        '8'  => 'gfj-fujita.ts013.icoma.jp',
        '9'  => 'demo-portal.site',
        '10' => 'gourmet.selva-i.co.jp',
    ],

    // 対応するべき画像サイズのパターン
    'image_size' => array(
        '1' => array('value' => '1', 'name' => 'h40'),
        '2' => array('value' => '2', 'name' => 'original'),
        '3' => array('value' => '3', 'name' => 'w183h55'),
        '4' => array('value' => '4', 'name' => 'w200'),
        '5' => array('value' => '5', 'name' => 'w200h60'),
        '6' => array('value' => '6', 'name' => 'w200h200'),
        '7' => array('value' => '7', 'name' => 'w212h141'),
        '8' => array('value' => '8', 'name' => 'w244h40'),
        '9' => array('value' => '9', 'name' => 'w250h167'),
        '10' => array('value' => '10', 'name' => 'w265h177'),
        '11' => array('value' => '11', 'name' => 'w300'),
        '12' => array('value' => '12', 'name' => 'w640h427'),
    ),

     // お問い合わせ区分
    'contact_type' => array(
        '1' => array('value' => '1', 'name' => '新規掲載の依頼'),
        '2' => array('value' => '2', 'name' => '掲載中の求人情報に関する質問'),
        '3' => array('value' => '3', 'name' => '掲載停止の依頼'),
        '0' => array('value' => '0', 'name' => 'その他'),
    ),

    // お問い合わせ 対応状況
    'contact_status' => array(
        '0' => array('value' => '0', 'name' => '未確認'),
        '1' => array('value' => '1', 'name' => '対応中'),
        '2' => array('value' => '2', 'name' => '対応済み')
    ),

    // お問い合わせ 対応状況
    'required_checkbox' => array(
        '1' => array('value' => '1', 'name' => 'チェックボックス（必須）を付けない'),
        '2' => array('value' => '2', 'name' => 'チェックボックス（必須）を付ける')
    ),

    // お問い合わせ内容（企業様向け）
    'company_contact_type' => array(
        '1' => array('value' => '1', 'name' => '人材を探している'),
        '2' => array('value' => '2', 'name' => 'サービスについて詳しく聞きたい'),
        '0' => array('value' => '0', 'name' => 'その他'),
    ),

    // カラーテーマ
    'color_theme' => array(
        '1' => array('value' => '1', 'name' => '濃い赤系'),
        '2' => array('value' => '2', 'name' => '明るい赤系'),
        '3' => array('value' => '3', 'name' => '濃い青系'),
        '4' => array('value' => '4', 'name' => '明るい青系'),
        '5' => array('value' => '5', 'name' => '濃い緑系'),
        '6' => array('value' => '6', 'name' => '明るい緑系'),
        '7' => array('value' => '7', 'name' => 'ピンク系'),
        '8' => array('value' => '8', 'name' => 'オレンジ系'),
        '9' => array('value' => '9', 'name' => '紫系')
    ),

    // ハローワーク取得のための都道府県コード（ 民間職業紹介事業者用の求人情報（一般））
    'hellowork_pref' => array(
       '1' => array('value' => 'M101', 'name' => '北海道'),
       '2' => array('value' => 'M102', 'name' => '青森県'),
       '3' => array('value' => 'M103', 'name' => '岩手県'),
       '4' => array('value' => 'M104', 'name' => '宮城県'),
       '5' => array('value' => 'M105', 'name' => '秋田県'),
       '6' => array('value' => 'M106', 'name' => '山形県'),
       '7' => array('value' => 'M107', 'name' => '福島県'),
       '8' => array('value' => 'M108', 'name' => '茨城県'),
       '9' => array('value' => 'M109', 'name' => '栃木県'),
       '10' => array('value' => 'M110', 'name' => '群馬県'),
       '11' => array('value' => 'M111', 'name' => '埼玉県'),
       '12' => array('value' => 'M112', 'name' => '千葉県'),
       '13' => array('value' => 'M113', 'name' => '東京都'),
       '14' => array('value' => 'M114', 'name' => '神奈川県'),
       '15' => array('value' => 'M115', 'name' => '新潟県'),
       '16' => array('value' => 'M116', 'name' => '富山県'),
       '17' => array('value' => 'M117', 'name' => '石川県'),
       '18' => array('value' => 'M118', 'name' => '福井県'),
       '19' => array('value' => 'M119', 'name' => '山梨県'),
       '20' => array('value' => 'M120', 'name' => '長野県'),
       '21' => array('value' => 'M121', 'name' => '岐阜県'),
       '22' => array('value' => 'M122', 'name' => '静岡県'),
       '23' => array('value' => 'M123', 'name' => '愛知県'),
       '24' => array('value' => 'M124', 'name' => '三重県'),
       '25' => array('value' => 'M125', 'name' => '滋賀県'),
       '26' => array('value' => 'M126', 'name' => '京都府'),
       '27' => array('value' => 'M127', 'name' => '大阪府'),
       '28' => array('value' => 'M128', 'name' => '兵庫県'),
       '29' => array('value' => 'M129', 'name' => '奈良県'),
       '30' => array('value' => 'M130', 'name' => '和歌山県'),
       '31' => array('value' => 'M131', 'name' => '鳥取県'),
       '32' => array('value' => 'M132', 'name' => '島根県'),
       '33' => array('value' => 'M133', 'name' => '岡山県'),
       '34' => array('value' => 'M134', 'name' => '広島県'),
       '35' => array('value' => 'M135', 'name' => '山口県'),
       '36' => array('value' => 'M136', 'name' => '徳島県'),
       '37' => array('value' => 'M137', 'name' => '香川県'),
       '38' => array('value' => 'M138', 'name' => '愛媛県'),
       '39' => array('value' => 'M139', 'name' => '高知県'),
       '40' => array('value' => 'M140', 'name' => '福岡県'),
       '41' => array('value' => 'M141', 'name' => '佐賀県'),
       '42' => array('value' => 'M142', 'name' => '長崎県'),
       '43' => array('value' => 'M143', 'name' => '熊本県'),
       '44' => array('value' => 'M144', 'name' => '大分県'),
       '45' => array('value' => 'M145', 'name' => '宮崎県'),
       '46' => array('value' => 'M146', 'name' => '鹿児島県'),
       '47' => array('value' => 'M147', 'name' => '沖縄県'),
    ),

    // 引用元に飛ぶ際のパラメータ（valueはconst.phpのis_usedに対応）
    'parameter_is_used' => array(
        '1' => array('value' => '2', 'name' => '付けない'),
        '2' => array('value' => '1', 'name' => '本サイトへ初回アクセスされた時の参照元情報を、パラメータに付与する（Indeed / Standby / 求人ボックス / Google for Jobs のみに対応）'),
    ),
    // 広告バナータイプ
    'advertising_banner_type' => [
        '1' => ['value' => '1', 'name' => '左カラムA'],
        '2' => ['value' => '2', 'name' => '左カラムB'],
        '3' => ['value' => '3', 'name' => '左カラムC'],
        '4' => ['value' => '4', 'name' => '右カラムA'],
        '5' => ['value' => '5', 'name' => '右カラムB'],
        '6' => ['value' => '6', 'name' => '右カラムC'],
    ],
    // 広告リンクタイプ
    'advertising_link_type' => [
        '1' => ['value' => '1', 'name' => '絶対パス(別ウィンドウで開く)'],
        '2' => ['value' => '2', 'name' => '相対パス(同一ウィンドウで開く)'],
        '3' => ['value' => '3', 'name' => '相対パス(別ウィンドウで開く)'],
    ],
    // 応募者向けステータス
    'entry_status_for_member' => array(
        '1' => array('value' => '1', 'name' => '連絡待ち'),
        '2' => array('value' => '2', 'name' => '面談調整中'),
        '3' => array('value' => '3', 'name' => '面談済み'),
        '4' => array('value' => '4', 'name' => '採用'),
        '5' => array('value' => '5', 'name' => '不採用'),
     ),
    // 求人情報の表示ステータス
    'area_search_type' => array(
        '1' => array('value' => '1', 'name' => '都道府県＋市区町村'),
        '2' => array('value' => '2', 'name' => '都道府県のみ'),
    ),

    // 応募・相談時、強制的に会員登録させる
    'force_register' => array(
        '1' => array('value' => '1', 'name' => 'なし'),
        '2' => array('value' => '2', 'name' => 'あり'),
    ),

    // GetScrapingData スクレイピング対象サービスID
    'scraping_service' => array(
        '1' => array('value' => 'GREEN', 'name' => 'GREEN'),
        '2' => array('value' => 'Careeela', 'name' => 'ケアーラ'),
        '3' => array('value' => 'TechStock', 'name' => 'TechStock'),
        '4' => array('value' => 'Yakumatch', 'name' => 'スプリングフィールド株式会社'),
        '5' => array('value' => 'EN', 'name' => 'エン転職'),
        '6' => array('value' => 'Rikunabi', 'name' => 'リクナビ派遣'),
        '7' => array('value' => 'Geekly', 'name' => 'Geekly'),
        '8' => array('value' => 'Furien', 'name' => 'furien'),
        '9' => array('value' => 'Paiza', 'name' => 'paiza転職'),
        '10' => array('value' => 'JobMedley', 'name' => 'ジョブメドレー'),
        '11' => array('value' => 'Guppy', 'name' => 'グッピー'),
        '12' => array('value' => 'NurseJinzaiBank', 'name' => 'ナース人材バンク'),
        '13' => array('value' => 'IryouWorker', 'name' => '医療ワーカー'),
        '14' => array('value' => 'KangoOshigoto', 'name' => '看護のお仕事'),
        '15' => array('value' => 'GoogleSearchJob', 'name' => 'googleしごと検索'),
        '16' => array('value' => 'HoikuNavi', 'name' => '保育ナビ'),
        '17' => array('value' => 'HoikuMynavi', 'name' => 'マイナビ保育士'),
        '18' => array('value' => 'HoikuKyuujin', 'name' => '保育求人ガイド'),
        '19' => array('value' => 'HoikuJinzaiBank', 'name' => '保育士人材バンク'),
        '20' => array('value' => 'HitoshiaHoiku', 'name' => 'ヒトシア'),
        '21' => array('value' => 'HoikushiWorker', 'name' => '保育士ワーカー'),
        '22' => array('value' => 'HoikushiBank', 'name' => '保育士バンク'),
        '23' => array('value' => 'LisuJob', 'name' => 'リスジョブ'),
        '24' => array('value' => 'HoikuShigoto', 'name' => '保育のお仕事'),
        '25' => array('value' => 'Asuka', 'name' => 'アスカ'),
	    '26' => array('value' => 'JobMedleyCw', 'name' => 'ジョブメドレー'),
        '27' => array('value' => 'GuppyCw', 'name' => 'グッピー'),
        '28' => array('value' => 'GuppyKaigo', 'name' => 'グッピー'),
        '29' => array('value' => 'JobMedleyKaigo', 'name' => 'ジョブメドレー'),
        '30' => array('value' => 'KaigoWorker', 'name' => '介護ワーカー'),
        '31' => array('value' => 'KaigoWork', 'name' => '介護ワーク'),
        '32' => array('value' => 'Kiracare', 'name' => 'きらケア'),
        '33' => array('value' => 'KaigoMynavi', 'name' => 'マイナビ介護職'),
        '34' => array('value' => 'KaigoMiraxs', 'name' => 'ミラクス介護'),
        '35' => array('value' => 'Yakukyari', 'name' => '薬キャリ'),
        '36' => array('value' => 'PharmaMynavi', 'name' => 'マイナビ薬剤師'),
        '37' => array('value' => 'PharmaStaff', 'name' => 'ファルマスタッフ'),
        '38' => array('value' => 'Phget', 'name' => 'ファゲット薬剤師'),
        '39' => array('value' => 'YakuzaishiWorker', 'name' => '薬剤師ワーカー'),
        '40' => array('value' => 'Apuro', 'name' => 'アプロ・ドットコム'),
        '41' => array('value' => 'YakuJob', 'name' => 'ヤクジョブ.com'),
        '42' => array('value' => 'PharmaCareer', 'name' => 'ファーマキャリア'),
        '43' => array('value' => 'GuppyApo', 'name' => 'グッピー（薬剤師）'),
        '44' => array('value' => 'JobMedleyApo', 'name' => 'ジョブメドレー'),
	    '45' => array('value' => 'KaigoWorker', 'name' => '介護ワーカー'),
        '46' => array('value' => 'KaigoMynavi', 'name' => 'マイナビ介護職'),
	    '47' => array('value' => 'KaigoMiraxs', 'name' => 'ミラクス介護'),
        '48' => array('value' => 'Kiracare', 'name' => 'きらケア'),
        '49' => array('value' => 'Kangoroo', 'name' => 'カンゴルー'),
        '50' => array('value' => 'SmileNurse', 'name' => 'スマイルナース'),
        '51' => array('value' => 'NursePower', 'name' => 'ナースパワー'),
        '52' => array('value' => 'KangoMynavi', 'name' => 'マイナビ看護師'),
        '53' => array('value' => 'JobMedleyKango', 'name' => 'ジョブメドレー（看護師）'),
        '54' => array('value' => 'GuppyKango', 'name' => 'グッピー（看護師）'),
        '55' => array('value' => 'NurseJinzaiBank', 'name' => 'ナース人材バンク'),
        '56' => array('value' => 'IryouWorker', 'name' => '医療ワーカー'),
        '57' => array('value' => 'NurseJob', 'name' => 'ナースジョブ'),
        '58' => array('value' => 'Iryode', 'name' => 'ナースではたらこ'),
        '59' => array('value' => 'SelworkYakuzaishi', 'name' => 'セルワーク薬剤師'),
        '60' => array('value' => 'CoMedical', 'name' => 'コメディカルドットコム'),
     ),
     

         // ライン 配信状況
    'line_status' => array(
        '1' => array('value' => '1', 'name' => '予約中'),
        '2' => array('value' => '2', 'name' => '送信中'),
        '3' => array('value' => '3', 'name' => '送信完了'),
    ),

    // ライン 未読既読
    'line_read_status' => array(
        '0' => array('value' => '0', 'name' => '未読'),
        '1' => array('value' => '1', 'name' => '既読'),
    ),

    // 会員登録時、LINE連携のSMSを送信する
    'line_sms' => array(
        '1' => array('value' => '1', 'name' => 'なし'),
        '2' => array('value' => '2', 'name' => 'あり'),
    ),


    // 求人XMLの共有方法
    'recruitment_xml_protocol' => [
        '1' => array('value' => '1', 'name' => 'HTTP（一般的なURLによる共有）'),
        '2' => array('value' => '2', 'name' => 'FTP'),
    ],

    // データありなし
    'exsist' => [
        '1' => ['value' => '1', 'name' => '有り'],
        '2' => ['value' => '2', 'name' => '無し'],
    ],

    // 求人おすすめ順タイプ
    'recruitment_recommend_type' => [
        '1' => array('value' => '1', 'name' => '表示優先度＋最終更新日時'),
        '2' => array('value' => '2', 'name' => '表示優先度＋点数'),
    ],
    
    // 管理画面のログ保存期間
    'log_lotate_setting' => [
        '1' => array('value' => '1', 'name' => '30日間で消す'),
        '2' => array('value' => '2', 'name' => 'ログは消さない（非推奨）'),
    ],
    
    // 求人グループ表示タイプ
    'recruitment_group_type' => [
        '1' => array('value' => '1', 'name' => '企業ID'),
        '2' => array('value' => '2', 'name' => '求人ID'),
    ],

    // 管理画面のログ保存期間
    'log_lotate_setting' => [
        '1' => array('value' => '1', 'name' => '30日間で消す'),
        '2' => array('value' => '2', 'name' => 'ログは消さない（非推奨）'),
    ],
    // 検索対象
    'target_for_search' => [
        '1' => array('value' => '1', 'name' => '自社登録'),
        '2' => array('value' => '2', 'name' => '他サイト'),
    ], 

    // 移動時間
    'transit_time' => [
        '1' => array('value' => '1', 'name' => '5分以内', 'range' => 0.4),
        '2' => array('value' => '2', 'name' => '10分以内', 'range' => 0.8),
        '3' => array('value' => '3', 'name' => '20分以内', 'range' => 1.6),
        '4' => array('value' => '4', 'name' => '30分以内', 'range' => 2.4),
    ], 
    // 情報の保持
    'info' => [
        '1' => array('value' => '1', 'name' => '企業名', 'column' => 'name'),
        '2' => array('value' => '2', 'name' => 'TEL', 'column' => 'telephone'),
        '3' => array('value' => '3', 'name' => 'FAX', 'column' => 'FAX'),
        '4' => array('value' => '4', 'name' => 'HP', 'column' => 'url'),
        '5' => array('value' => '5', 'name' => '問い合わせ', 'column' => 'contact_url'),
    ], 
    // 施設/表示項目の選択
    'select_items_facility' => [
        '1' => array('value' => '企業名', 'name' => 'name'),
        '2' => array('value' => '施設形態', 'name' => 'facility_form'),
        '3' => array('value' => '住所', 'name' => 'address'),
        '4' => array('value' => 'アクセス', 'name' => 'access'),
    ], 
    // 業種
    'industry_type' => [
        '1' => array('value' => '1', 'name' => '薬剤師'),
        '2' => array('value' => '2', 'name' => '保育'),
        '3' => array('value' => '3', 'name' => '介護'),
        '4' => array('value' => '4', 'name' => '看護'),
    ], 
    // 掲載開始日
    'created_at_start' => [
        '1' => array('value' => '1', 'name' => '１日以内', 'range' => 1),
        '2' => array('value' => '2', 'name' => '２日以内', 'range' => 2),
        '3' => array('value' => '3', 'name' => '３日以内', 'range' => 3),
        '4' => array('value' => '4', 'name' => '１週間以内', 'range' => 7),
        '5' => array('value' => '5', 'name' => '２週間以内', 'range' => 14),
        '6' => array('value' => '6', 'name' => '１ヶ月以内', 'range' => 31),
        '7' => array('value' => '7', 'name' => '６ヶ月以内', 'range' => 186),
        '8' => array('value' => '8', 'name' => '１年以内', 'range' => 365),
        '9' => array('value' => '9', 'name' => '問わない', 'range' => ''),
    ], 
    // 学校種別
    'school_type' => [
        '1' => array('value' => '1', 'name' => '大学院'),
        '2' => array('value' => '2', 'name' => '四年制大学'),
        '3' => array('value' => '3', 'name' => '短期大学'),
        '4' => array('value' => '4', 'name' => '高等専門学校'),
        '5' => array('value' => '5', 'name' => '専門学校'),
        '6' => array('value' => '6', 'name' => 'その他'),
        '7' => array('value' => '7', 'name' => '日本語学校'),
    ],
    // 掲載プラン 基本設定
    'plan_setting' => [
        '1'  => array('value' => 'topplan_1_1' , 'name' => '上位プラン 1枠 1ヶ月'),
        '2'  => array('value' => 'topplan_1_3' , 'name' => '上位プラン 1枠 3ヶ月'),
        '3'  => array('value' => 'topplan_1_6' , 'name' => '上位プラン 1枠 6ヶ月'),
        '4'  => array('value' => 'topplan_1_12', 'name' => '上位プラン 1枠 12ヶ月'),
        '5'  => array('value' => 'topplan_3_1' , 'name' => '上位プラン 3枠 1ヶ月'),
        '6'  => array('value' => 'topplan_3_3' , 'name' => '上位プラン 3枠 3ヶ月'),
        '7'  => array('value' => 'topplan_3_6' , 'name' => '上位プラン 3枠 6ヶ月'),
        '8'  => array('value' => 'topplan_3_12', 'name' => '上位プラン 3枠 12ヶ月'),
        '9'  => array('value' => 'topplan_5_1' , 'name' => '上位プラン 5枠 1ヶ月'),
        '10' => array('value' => 'topplan_5_3' , 'name' => '上位プラン 5枠 3ヶ月'),
        '11' => array('value' => 'topplan_5_6' , 'name' => '上位プラン 5枠 6ヶ月'),
        '12' => array('value' => 'topplan_5_12', 'name' => '上位プラン 5枠 12ヶ月'),
        '13' => array('value' => 'midplan_1_1' , 'name' => '中位プラン 1枠 1ヶ月'),
        '14' => array('value' => 'midplan_1_3' , 'name' => '中位プラン 1枠 3ヶ月'),
        '15' => array('value' => 'midplan_1_6' , 'name' => '中位プラン 1枠 6ヶ月'),
        '16' => array('value' => 'midplan_1_12', 'name' => '中位プラン 1枠 12ヶ月'),
        '17' => array('value' => 'midplan_3_1' , 'name' => '中位プラン 3枠 1ヶ月'),
        '18' => array('value' => 'midplan_3_3' , 'name' => '中位プラン 3枠 3ヶ月'),
        '19' => array('value' => 'midplan_3_6' , 'name' => '中位プラン 3枠 6ヶ月'),
        '20' => array('value' => 'midplan_3_12', 'name' => '中位プラン 3枠 12ヶ月'),
        '21' => array('value' => 'midplan_5_1' , 'name' => '中位プラン 5枠 1ヶ月'),
        '22' => array('value' => 'midplan_5_3' , 'name' => '中位プラン 5枠 3ヶ月'),
        '23' => array('value' => 'midplan_5_6' , 'name' => '中位プラン 5枠 6ヶ月'),
        '24' => array('value' => 'midplan_5_12', 'name' => '中位プラン 5枠 12ヶ月'),
        '25' => array('value' => 'botplan_1_1' , 'name' => '下位プラン 1枠 1ヶ月'),
        '26' => array('value' => 'botplan_1_3' , 'name' => '下位プラン 1枠 3ヶ月'),
        '27' => array('value' => 'botplan_1_6' , 'name' => '下位プラン 1枠 6ヶ月'),
        '28' => array('value' => 'botplan_1_12', 'name' => '下位プラン 1枠 12ヶ月'),
        '29' => array('value' => 'botplan_3_1' , 'name' => '下位プラン 3枠 1ヶ月'),
        '30' => array('value' => 'botplan_3_3' , 'name' => '下位プラン 3枠 3ヶ月'),
        '31' => array('value' => 'botplan_3_6' , 'name' => '下位プラン 3枠 6ヶ月'),
        '32' => array('value' => 'botplan_3_12', 'name' => '下位プラン 3枠 12ヶ月'),
        '33' => array('value' => 'botplan_5_1' , 'name' => '下位プラン 5枠 1ヶ月'),
        '34' => array('value' => 'botplan_5_3' , 'name' => '下位プラン 5枠 3ヶ月'),
        '35' => array('value' => 'botplan_5_6' , 'name' => '下位プラン 5枠 6ヶ月'),
        '36' => array('value' => 'botplan_5_12', 'name' => '下位プラン 5枠 12ヶ月'),
    ],
];
