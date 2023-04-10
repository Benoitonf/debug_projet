<?php

    function getPercent($percent = null, $of = null , $result =null){

        if($result === null){
            $result = $percent * $of / 100;

            return [
                'result' => $result,
            ];
        }
        if($percent === null){
            $percent = $of / $result * 100;

            return [
                'percent' => $percent,
            ];
        }
        if($of === null){
            $of = $result * 100 / $percent;

            return [
                'of' => $of,
            ];
        }
    }

    function ruleOfThird($a = 1, $b = 1, $c = 1): array
    {
        return [
            'd' => ($b * $c)  / $a,
        ];
    }

    function cesar($clear, $key, $reverse = false) {
        if ($key > 25 || $key < 0)
            return [];
        
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet = str_split($alphabet);
        $accents = array(
            'à' => 'a','â' => 'a','ä' => 'a','é' => 'e','è' => 'e','ê' => 'e','ë' => 'e','î' => 'i','ï' => 'i','ô' => 'o','ö' => 'o','ù' => 'u','û' => 'u','ü' => 'u','ÿ' => 'y','ç' => 'c','À' => 'A','Â' => 'A','Ä' => 'A','É' => 'E','È' => 'E','Ê' => 'E','Ë' => 'E','Î' => 'I','Ï' => 'I','Ô' => 'O','Ö' => 'O','Ù' => 'U','Û' => 'U','Ü' => 'U','Ÿ' => 'Y','Ç' => 'C'
        );

        $clear = str_replace("'", "", $clear);
        $tolower = strtolower($clear);
        $removeAccent = strtr($tolower, $accents);

        $clear = str_split($removeAccent);
        $result = '';

        foreach ($clear as $letter) {
            if (ctype_alpha($letter)) {
                $index = array_search($letter, $alphabet);
                $index = $reverse ? $index - $key : $index + $key;

                if($index > (count($alphabet) - 1)) {
                    $index = $index % count($alphabet);
                } else if ($index < 0){
                    $index += count($alphabet);
                }
                $result .= $alphabet[$index];
            }
            else {
                $result .= $letter;
            }
        }

        if($reverse){
            return [
                'clear' => $result,
            ];
        } else {
            return [
                'result' => $result,
            ];
        }
    }

    function convertEuroDollars($euro = null, $dollars = null){
        $currency = $euro === null ? 'USD' : 'EUR';
        $reverseCurrency = $currency === 'EUR' ? 'USD' : 'EUR';

        $url = 'https://open.er-api.com/v6/latest/' . $currency;

        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $rate = $data['rates'][$reverseCurrency];

        if($euro === null){
            $euro = $dollars * $rate;
            return [
                'EUR' => $euro,
            ];
        }
        if($dollars === null){
            $dollars = $euro * $rate;
            return [
                'USD' => $dollars,
            ];
        }
    }

    function convertCurrencies($from, $to, $amount) {
        $url = 'https://open.er-api.com/v6/latest/' . $from;
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $rate = $data['rates'][$to];

        return [
            'RESULT' => round($amount * $rate, 2)
        ];
    }

    function convertVolumes($from, $to, $amount) {
        return [
            'RESULT' => $amount * $from / $to
        ];
    }
