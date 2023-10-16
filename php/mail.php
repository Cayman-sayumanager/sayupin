<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // POSTからデータを取得
    $company = $_POST['company'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phonenumber = $_POST['phonenumber'];
    $budget = $_POST['budget'];
    $content = $_POST['content'];

    // お問い合わせ概要を取得
    $inquiryDetails = [];
    if (isset($_POST['SNSVideoProduction'])) $inquiryDetails[] = "SNS動画制作";
    if (isset($_POST['SNSConsultation'])) $inquiryDetails[] = "SNS相談";
    // ... 他のチェックボックスも同様に取得 ...

    // メール内容の作成
    $message = "会社名: $company\n";
    $message .= "名前: $name\n";
    $message .= "メールアドレス: $mail\n";
    $message .= "電話番号: $phonenumber\n";
    $message .= "予算: $budget\n";
    $message .= "お問い合わせ概要: " . implode(", ", $inquiryDetails) . "\n";
    $message .= "お問い合わせ内容: $content";

    // メールの送信設定
    $to = 'recipient@example.com'; // 宛先のメールアドレスを設定
    $subject = '新しいお問い合わせ'; // 件名を設定
    $headers = "From: webmaster@example.com\r\n"; // 送信元のメールアドレスや返信先などを設定
    $headers .= "Reply-To: $mail\r\n";

    // メールの送信
    if (mail($to, $subject, $message, $headers)) {
        echo "メールを送信しました。";
    } else {
        echo "メールの送信に失敗しました。";
    }
}

?>
