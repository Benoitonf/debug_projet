<?php
header('Content-Type: application/json');
http_response_code(200);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

/*
 * GET BODY
 * */
$json = file_get_contents('php://input');
$body = json_decode($json); // Converts it into a PHP object
$result = null;
if($body === null){
    $data = [
        'response' => 'error',
        'message' => 'No data sent'
    ];
    echo json_encode($data);
    exit;
}

if(!isset($body->form)){
    $data = [
        'response' => 'error',
        'message' => 'No form name'
    ];
    echo json_encode($data);
    exit;
}


switch ($body->form){
    case 'percent':
        $percent = null;
        $of = null;

        if(isset($body->percent)){
            $percent = $body->percent;
        }
        if(isset($body->result)){
            $result = $body->result;
        }
        if(isset($body->of)){
            $of = $body->of;
        }

        $result = getPercent($percent, $of, $result);

        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        echo json_encode($data);
        break;
    case 'regle-de-trois':
        $a = $body->a;
        $b = $body->b;
        $c = $body->c;

        $result = ruleOfThird($a, $b, $c);

        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        echo json_encode($data);
        break;
    case 'cesar':
        $reverse = false;
        $text = '';
        if(property_exists($body, 'result')) {
            $reverse = true;
            $text = $body->result;
        } else {
            $text = $body->clear;
        }
        $key = $body->key;

        $result = cesar($text, $key, $reverse);

        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        echo json_encode($data);
        break;
    case 'convert':

        $AMOUNT = null;
        $FROM = null;
        $TO = null;
        if(property_exists($body, 'AMOUNT')){
            $AMOUNT = $body->AMOUNT;
        }
        if(property_exists($body, 'FROM')){
            $FROM = $body->FROM;
        }
        if(property_exists($body, 'TO')){
            $TO = $body->TO;
        }

        if (property_exists($body, 'DEVISE')) {
            $result = convertCurrencies($FROM, $TO, $AMOUNT);
        }
        if (property_exists($body, 'VOLUME')) {
            $result = convertVolumes($FROM, $TO, $AMOUNT);
        }


        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        echo json_encode($data);
        break;
}

logSubmitToDatabase($body, $result);

exit;
