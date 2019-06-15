<?php

function getTry() {
    try {
        echo "hello world";
        $re = 12;
        return $re;
    } catch (Exception $e) {
        var_dump($e->getMessage(), $e->getTraceAsString());
        return false;
    } finally {
        echo 'chris';
//         return true;
    }
}

var_dump(getTry());




