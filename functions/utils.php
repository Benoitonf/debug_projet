<?php

    function logSubmitToDatabase($body, $result = null){
        $cols = [
            'form' => $body->form,
            'data' => json_encode($body, JSON_HEX_APOS),
            'result' => $result !== null ? json_encode($result) : null,
        ];
        insert('logs', $cols);
    }
