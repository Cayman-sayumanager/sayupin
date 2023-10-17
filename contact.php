<?php
//メール処理
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $subject = '';
    $company = '';
    $name = '';
    $mail = '';
    $phone = '';
    $budget = '';
    $chance = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $subject = $_POST['subject'];
    $company = $_POST['company'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $budget = $_POST['budget'];
    $chance = $_POST['chance'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $mail == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }

    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = 'ricky.kurumi.miruku@ymail.ne.jp'; // 宛先
        $headers = "From: " . $mail . "\r\n";

        // 本文の最後に名前を追加
        $message .= "\r\n\r\nきっかけ:" . implode(", ", $chance) ."\r\n予算:" . $budget . "\r\n" . $company . "\r\n". $mail . "\r\n" . $phone . "\r\n" . $name;

        // タイトル
        $subject = implode(", ", $subject) . "について";

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = '送信されました！';

        // 全てクリア
        $subject = '';
        $company = '';
        $name = '';
        $mail = '';
        $phone = '';
        $budget = '';
        $chance = '';
        $message = '';
        $err_msg = '';
        $complete_msg = '';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="サービスへの問い合わせフォーム">
  <title>お問い合わせ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/html5reset-1.6.1.css">
  <link rel="stylesheet" href="css/gallery.css">
</head>
<body>
  <main>
  <!--ナビバー-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">さゆぴんハウス</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
              <a href="aboutme.html" class="nav-link">Aboutme</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="service.html" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              サービス
            </a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-light" href="service_Instagram.html">Instagram運用</a></li>
              <li><a class="dropdown-item text-light" href="service_TikTok.html">TikTok運用</a></li>
              <li><a class="dropdown-item text-light" href="service_SNSConsulting.html">SNSコンサルティング運用</a></li>
              <li><a class="dropdown-item text-light" href="service_VideoCreation.html">動画制作</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="works.html" class="nav-link">実績</a>
          </li>
          <li class="nav-item">
            <a href="contact.php" class="nav-link active">問い合わせ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--お問い合わせフォーム-->
  <div class="container text-center mt-10">
      <h2 class="fs-1 mb-5 fw-bold">お問い合わせ</h2>
      <div class="container text-start">
        <form method="post"">
          <p class="mt-2">問い合わせ概要</p>
          <div class="mb-3 mt-2 form-check-inline">
            <input class="form-check-input" type="checkbox" name="subject[]" value="運用代行" id="SNSVideoProduction">
            <label class="form-check-label " for="SNSVideoProduction">
              運用代行
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="subject[]" value="SNS相談" id="SNSConsultation">
            <label class="form-check-label" for="SNSConsultation">
              SNS相談
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="subject[]" value="動画制作" id="VideoCreation">
            <label class="form-check-label" for="VideoCreation">
              動画制作
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="subject[]" value="メディア出演" id="MediaAppearance">
            <label class="form-check-label" for="MediaAppearance">
              メディア出演
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="subject[]" value="その他" id="others1">
            <label class="form-check-label" for="others1">
              その他
            </label>
          </div>
          <div class="mb-3">
            <p class="mt-2">会社名</p>
            <input type="text" class="form-control mt-2" name="company" placeholder="会社名" value="<?php echo $company; ?>">
          </div>
          <div class="mb-3">
            <p class="mt-2">名前</p>
            <input type="text" class="form-control mt-2" name="name" placeholder="名前（必須）" value="<?php echo $name; ?>" required>
          </div>
          <div class="mb-3">
            <p class="mt-2">メールアドレス</p>
            <input type="text" class="form-control mt-2" name="mail" placeholder="メールアドレス（必須）" value="<?php echo $mail; ?>" required>
          </div>
          <div class="mb-3">
            <p class="mt-2">電話番号</p>
            <input type="text" class="form-control mt-2" name="phone" placeholder="（例）09012345678" value="<?php echo $phone; ?>">
          </div>
          <div class="mb-3">
            <p class="mt-2">予算（万円）</p>
            <input type="text" class="form-control mt-2" name="budget" placeholder="（例）20" value="<?php echo $budget; ?>">
          </div>
          <p class="mt-2">サービスを知ったきっかけ</p>
          <div class="mb-3 mt-2 form-check-inline">
            <input class="form-check-input" type="checkbox" name="chance[]" value="さゆぴんのSNS" id="SayupinSNS">
            <label class="form-check-label" for="SayupinSNS">
              さゆぴんのSNS
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="chance[]" value="各種メディア" id="Media">
            <label class="form-check-label" for="Media">
              各種メディア
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="chance[]" value="インターネット検索" id="Internet">
            <label class="form-check-label" for="Internet">
              インターネット検索
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="chance[]" value="広告" id="Advertisement">
            <label class="form-check-label" for="Advertisement">
              広告
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="chance[]" value="知人の紹介" id="Introduction">
            <label class="form-check-label" for="Introduction">
              知人の紹介
            </label>
          </div>
          <div class="mb-3 form-check-inline">
            <input class="form-check-input" type="checkbox" name="chance[]" value="その他" id="others2">
            <label class="form-check-label" for="others2">
              その他
            </label>
          </div>
          <div class="mb-4">
            <p class="mt-2">お問い合わせ内容</p>
            <textarea class="form-control mt-2" name="message" rows="5" placeholder="メッセージを入力してください"><?php echo $message; ?></textarea>
          </div>
          <div class="mb-4">
              <p class="overflow-auto" style="max-height: 200px;">
                プライバシーポリシー<br>
                <br><br>
                本ウェブサイト上で提供するサービス（以下,「本サービス」といいます。）における，ユーザーの個人情報の取扱いについて，以下のとおりプライバシーポリシー（以下，「本ポリシー」といいます。）を定めます。<br>
                <br>
                第1条（個人情報）<br>
                <br>
                「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。<br>
                <br>
                第2条（個人情報の収集方法）<br>
                <br>
                当社は，ユーザーが利用登録をする際に氏名，生年月日，住所，電話番号，メールアドレスなどの個人情報をお尋ねすることがあります。また，ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や決済に関する情報を,当社の提携先（情報提供元，広告主，広告配信先などを含みます。以下，｢提携先｣といいます。）などから収集することがあります。<br>
                <br>
                第3条（個人情報を収集・利用する目的）<br>
                <br>
                当社が個人情報を収集・利用する目的は，以下のとおりです。<br>
                ・提供するサービスに関し、商談、契約手続、取引先管理、受発注業務、請求支払業務、その他これらに付随する業務の遂行のため<br>
                ・アンケート調査や利用状況等を分析し、当社サービス・商品の改善、当社の新サービス<br>
                ・当社の開催(共催)するイベント、セミナー、新サービス等のご案内のため<br>
                ・ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）<br>
                <br>
                第4条（利用目的の変更）<br>
                <br>
                1.当社は，利用目的が変更前と関連性を有すると合理的に認められる場合に限り，個人情報の利用目的を変更するものとします。<br>
                2.利用目的の変更を行った場合には，変更後の目的について，当社所定の方法により，ご本人に通知し，または本ウェブサイト上に公表するものとします。<br>
                <br>
                第5条（個人情報の第三者提供）<br>
                <br>
                1.当社は，次に掲げる場合を除いて，あらかじめユーザーの同意を得ることなく，第三者に個人情報を提供することはありません。ただし，個人情報保護法その他の法令で認められる場合を除きます。<br>
                1.1.人の生命，身体または財産の保護のために必要がある場合であって，本人の同意を得ることが困難であるとき<br>
                1.2.公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって，本人の同意を得ることが困難であるとき<br>
                1.3.国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって，本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき<br>
                1.4.予め次の事項を告知あるいは公表し，かつ当社が個人情報保護委員会に届出をしたとき<br>
                1.4.1.利用目的に第三者への提供を含むこと<br>
                1.4.2.第三者に提供されるデータの項目<br>
                1.4.3.第三者への提供の手段または方法<br>
                1.4.4.本人の求めに応じて個人情報の第三者への提供を停止すること<br>
                1.4.5.本人の求めを受け付ける方法<br>
                2.前項の定めにかかわらず，次に掲げる場合には，当該情報の提供先は第三者に該当しないものとします。<br>
                2.1当社が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合<br>
                2.2合併その他の事由による事業の承継に伴って個人情報が提供される場合<br>
                2.3個人情報を特定の者との間で共同して利用する場合であって，その旨並びに共同して利用される個人情報の項目，共同して利用する者の範囲，利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について，あらかじめ本人に通知し，または本人が容易に知り得る状態に置いた場合<br>
                <br>
                第6条（個人情報の開示）<br>
                <br>
                1.当社は，本人から個人情報の開示を求められたときは，本人に対し，遅滞なくこれを開示します。ただし，開示することにより次のいずれかに該当する場合は，その全部または一部を開示しないこともあり，開示しない決定をした場合には，その旨を遅滞なく通知します。なお，個人情報の開示に際しては，1件あたり1，000円の手数料を申し受けます。<br>
                1.1.本人または第三者の生命，身体，財産その他の権利利益を害するおそれがある場合<br>
                1.2.当社の業務の適正な実施を妨げるおそれがある場合<br>
                1.3.その他の法令に違反することとなる場合<br>
                2.前項第1号に該当する場合において，本人がご自身の保護または第三者の権利利益のための措置を講じることが困難であるときは，本人の代理人に対し，この第6条第1項各号に定める事由が存在する旨を通知するものとします。<br>
                <br>
                第7条（個人情報の訂正および削除）<br>
                <br>
                1. ユーザーは、当社の保有する自己の個人情報が真実でない場合には、個人情報保護法の定めに基づき、当社に対して個人情報の訂正または削除を求めることができます。<br>
                2. 当社は、ユーザーから前項の請求を受けた場合には、適切な方法でユーザーの個人情報を訂正または削除します。<br>
                3. 当社は、前項の訂正または削除を行った場合、または行わない場合には、これをユーザーに通知します。<br>
                <br>
                第8条（個人情報の利用停止等）<br>
                <br>
                1. 当社は、ユーザーから、ユーザーの個人情報が個人情報保護法の定める基準に違反して取り扱われているという理由または偽りその他不正の手段により取得されたものであるという理由から、その利用の停止または削除を求められた場合には、必要な調査を行います。<br>
                2. 前項の結果、請求が当該法の定める基準に適合することが判明した場合には、ユーザーの個人情報の利用停止または削除を行います。<br>
                3. 当社は、前項の利用停止または削除を行った場合、または行わない場合には、これをユーザーに通知します。<br>
                4. 当社が利用停止または削除を行わない理由がある場合は、ユーザーにその理由を明示します。<br>
                <br>
                第9条（プライバシーポリシーの変更）<br>
                <br>
                1. 本ポリシーの内容は、ユーザーに通知することなく、変更することができるものとします。<br>
                2. 当社が別途定める場合を除いて、変更後のプライバシーポリシーは、本ウェブサイトに掲載したときから効力を生じるものとします。<br>
                <br>
                第10条（お問い合わせ窓口）<br>
                <br>
                本ポリシーに関するお問い合わせは、下記の窓口までお願いいたします。<br>
                <br><br>
                木下紗由莉<br>
                Eメールアドレス：ricky.kurumi.miruku@ymail.ne.jp<br><br>

                以上
              </p>
          </div>
          <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
              <label class="form-check-label" for="flexCheckIndeterminate">
                上記プライバシーポリシーに同意します。
              </label>
          </div>
          <!--メッセージ状態表示-->
          <?php if ($err_msg != ''): ?>
              <div class="alert alert-danger">
                  <?php echo $err_msg; ?>
              </div>
          <?php endif; ?>

          <?php if ($complete_msg != ''): ?>
              <div class="alert alert-success">
                  <?php echo $complete_msg; ?>
              </div>
          <?php endif; ?>

          <div class="text-center pt-4 col-md-6 offset-md-3">
              <button type="submit" class="btn btn-primary">送信</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!--フッター-->
	<footer class="py-4 mt-5 bg-dark text-center">
    <p class="text-white-50 mt-1 fs-4">最新の投稿はこちらから</p>
    <div class="row gy-2 mt-2">
      <a class="col-2 iconarea px-0" href="https://www.instagram.com/sayu_pinscher/">
        <div style="background: linear-gradient(to right,rgba(247, 207, 0, 0.7), rgba(246, 37, 2, 0.7) 45%, rgba(182, 47, 82, 0.7) 75%, rgba(113, 58, 166, 0.7));" >
          <i class="bi bi-instagram " style="font-size: 2rem; color: #fff;"></i>
        </div>
      </a>
      <a class="col-2 iconarea px-0"  href="https://www.threads.net/@sayu_pinscher">
        <div style="background: #000000">
          <i class="bi bi-threads" style="font-size: 2rem; color: #fff;"></i>
        </div>
      </a>
      <a class="col-2 iconarea px-0"  href="https://www.youtube.com/@sayu_pinscher" >
        <div style="background: #ff0000">
          <i class="bi bi-youtube" style="font-size: 2rem; color: #fff;"></i>
        </div>
      </a>
      <a class="col-2 iconarea px-0"  href="https://www.tiktok.com/@you_pinscher">
        <div style="background: #000000"> 
          <i class="bi bi-tiktok" style="font-size: 2rem; color: #fff;"></i>
        </div>
      </a>
      <a class="col-2 iconarea px-0"  href="https://linevoom.line.me/user/_dau5zaxWHr0EKPbUaJG-kwfSFyfZzdDB9zwkVfQ">
        <div style="background: #00B900">
          <i class="bi bi-line" style="font-size: 2rem; color: #fff;"></i>
        </div>
      </a>
      <a class="col-2 iconarea px-0"  href="https://www.facebook.com/profile.php?id=100044332763307">
        <div style="background: #3B5998">
          <i class="bi bi-facebook" style="font-size: 2rem; color: #fff;"></i>
        </div>
      </a>
		</div>

    <!--遊び-->
    <!-- <p class="text-white-50 mt-3">BIG SPONSOR</p>
    <div class="row">
      <div class="col-2 px-2">
        <img class="mt-2" src="images/TSUKOSHI.png" style="width: 100%; border-radius: 10px;"></img>
      </div>
      <div class="col-2 px-2">
        <img class="mt-2" src="images/TSUKOSHI.png" style="width: 100%; border-radius: 10px;"></img>
      </div>
      <div class="col-2 px-2">
        <img class="mt-2" src="images/TSUKOSHI.png" style="width: 100%; border-radius: 10px;"></img>
      </div>
      <div class="col-2 px-2">
        <img class="mt-2" src="images/TSUKOSHI.png" style="width: 100%; border-radius: 10px;"></img>
      </div>
      <div class="col-2 px-2">
        <img class="mt-2" src="images/TSUKOSHI.png" style="width: 100%; border-radius: 10px;"></img>
      </div>
      <div class="col-2 px-2">
        <img class="mt-2" src="images/TSUKOSHI.png" style="width: 100%; border-radius: 10px;"></img>
      </div>
    </div> -->
    <div class="mt-2">
      <small class="text-white-50">Designed and Developed by <a href="https://www.instagram.com/sayu_manager/">Cayman</a></small>
    </div>
	</footer>
  <!--カウントアップ用-->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/protonet-jquery.inview/1.1.2/jquery.inview.min.js"></script>
  <!--Bootstrap用-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!--main-->
  <script src="js/main.js"></script>
  <!--Youtube埋め込み用-->
  <script src="https://www.youtube.com/iframe_api"></script>
</body>
</html>