<?php
require_once(__DIR__.'/stripe-php/init.php');
$priceId = $_POST['priceId'];
header('Content-Type: application/json');

$stripe = new \Stripe\StripeClient(
  'sk_test_5yMCDQk1Jypb3ocQ3OZYOWJR00tAmPIlYC'
);
$result = $stripe->checkout->sessions->create([
  'success_url' => 'https://landing.lineml.jp/r/1512410235-YvNDdggp?lp=gKswXA',
  'cancel_url' => 'https://s-par.com/ecoach/stripe/',
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price' => $priceId,
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
]);
header("HTTP/1.1 303 See Other");
header("Location: " . $result->url);



