<?php
    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder
    
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    MercadoPago\SDK::setAccessToken("TEST-2328908812279734-070509-4e87e2b552a20611336e91b2ae03743e-530429288"); // Either Production or SandBox AccessToken
    

     $form = $_REQUEST['json'];
     $formDecoded = json_decode($form);

      $float = floatval($formDecoded->transaction_amount);
      $integer = intval($formDecoded->installments);

     $payment = new MercadoPago\Payment();
  
      $payment->transaction_amount = $float;
      $payment->token = $formDecoded->token;
      $payment->description = $formDecoded->description;
      $payment->installments = $integer;
      $payment->payment_method_id = $formDecoded->payment_method_id;
      $payment->payer = array(
        "email" => $formDecoded->email,
        "identification" => array(
          "type" => $formDecoded->identification->type,
          "number" =>$formDecoded->identification->number
       )
     );
     //$payment->notification_url = "http://localhost:8100/";
    
      $payment->save();
      echo $payment->status;
      
  
      ?>