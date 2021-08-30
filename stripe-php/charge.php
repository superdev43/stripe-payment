<?php

// 他のライブラリを読み込み
require_once('../../../../../../wp-load.php');
require_once('init.php');

// APIキー登録
$stripe = array(
  "secret_key"      => "sk_test_eiLLcRJrPQtM92MRUKnfwPmC006VIttxo3",
  "publishable_key" => "pk_test_QfOeJIuTK250V5DkUxhjHLVV00aYup1mo9"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);

// Checkput.jsからPOSTされたトークンとメールアドレスを代入
$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];

// 決済額を設定
$price  = '100';

// 顧客を作成
$customer = \Stripe\Customer::create(array(
    'email' => $email,
    'source'  => $token
));

// チャージを作成
$charge = \Stripe\Charge::create(array(
    'customer' => $customer->id,
    'amount'   => $price,
    'currency' => 'jpy'
));

// 処理が完了したら完了ページへリダイレクト
header('Location: '.USCES_CART_URL);

?>