<?php

define('USERNAME', 'USERNAME');                           //username of online shopping system
define('PASSWORD', 'PASSWORD');                          //password of online shopping system
define('GATEWAY_URL', 'https://server/payment/rest/');  //gate for open payment,please put your link of online shopping   https://server/payment/rest/
define('RETURN_URL', '../index.php');                   //here put your directory if payment succes                       https://server/index.php/
define('FAILED_URL', 'http://server/payment/failed/');  //here put your directory if payment failed or  message system made in this code

function gateway($method, $data) {
    $curl = curl_init(); // Инициализируем запрос
    curl_setopt_array($curl, array(
        CURLOPT_URL => GATEWAY_URL.$method,             // done adress of method
        CURLOPT_RETURNTRANSFER => true,                 // return response
        CURLOPT_POST => true,                           // method POST
        CURLOPT_POSTFIELDS => http_build_query($data)   // data request
    ));
    $response = curl_exec($curl);                       // making request

//response displaying as array
    $response = json_decode($response, true);    // decode  from JSON to array
    curl_close($curl);                                  // closing connection(curl)
    return $response;                                   // return  response
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['orderId'])) {
    echo '
        <form method="post" action="../form/index.php">
            <label>Order number</label><br />
            <input type="text" name="orderNumber" /><br />
            <label>Amount</label><br />
            <input type="text" name="amount" /><br />
            <button type="submit">Pay</button>
        </form>
    ';
}


else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = array(
        'userName' => USERNAME,
        'password' => PASSWORD,
        'orderNumber' => urlencode($_POST['orderNumber']),
        'amount' => urlencode($_POST['amount']),
        'returnUrl' => RETURN_URL
    );


    $response = gateway('register.do', $data);


    $response = gateway('registerPreAuth.do', $data);

    if (isset($response['errorCode'])) {                                 // show message error
        echo 'Ошибка #' . $response['errorCode'] . ': ' . $response['errorMessage'];
    } else {                                                             // if succes made order send user to payment form
        header('Location: ' . $response['formUrl']);
        die();
    }
}


else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['orderId'])){
    $data = array(
        'userName' => USERNAME,
        'password' => PASSWORD,
        'orderId' => $_GET['orderId']
    );


    $response = gateway('getOrderStatus.do', $data);

    // display error code and status order
    echo '
        <b>Error code:</b> ' . $response['ErrorCode'] . '<br />
        <b>Order status:</b> ' . $response['OrderStatus'] . '<br />
    ';
}
?>