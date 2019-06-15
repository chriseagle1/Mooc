<?php
function bubbleSort($arr) {
    $len = count($arr);
    for($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $len - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j+1] = $tmp;
            }
        }
    }
    
    return $arr;
}

function selectSort($arr) {
    $len = count($arr);
    
    for ($i = 0; $i < $len; $i++) {
        $index = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$index] > $arr[$j]) {
                $index = $j;
            }
        }
        $tmp = $arr[$index];
        $arr[$index] = $arr[$i];
        $arr[$i] = $tmp;
    }
    return $arr;
}

function fib($n) {
    $arr = [];
    for ($i = 0; $i < $n; $i++) {
        if ($i == 0 || $i == 1) {
            $arr[$i] = 1;
        } else {
            $arr[$i] = $arr[$i - 1] + $arr[$i - 2];
        }
    }
    return array_pop($arr);
}

function fibRecu($n) {
    if ($n == 1 || $n == 2) {
        return 1;
    } else {
        return fibRecu($n - 1) + fibRecu($n - 2);
    }
}

function convert($str) {
    $arr = explode('_', $str);
    
    $resArr = array_map(function($item) {
        return ucfirst($item);
    }, $arr);
    
    echo implode('', $resArr);
}

function cStrrev($str) {
    $len = strlen($str);
    for ($i = 0, $j = $len - 1; $i < $j; $i++, $j--) {
        $tmp = $str[$i];
        $str[$i] = $str[$j];
        $str[$j] = $tmp;
        
    }
    return $str;
}
//$a = [2,3,5,6,4,1,7,10];
//1,1,2,3,5,8,13,21
//$res = bubbleSort($a);
//$res = selectSort($a);
// $str = 'make_by_id';
// echo cStrrev($str) . "\n";
// echo strrev($str);
$arr1 = [1,2,3]; 
$arr2 = [2,3,4,5,6];

$arr3 = [
    'name' => 'chris',
    'age' => 30,
    'book' => 'php'
];
$arr4 = [
    'name' => 'yuanbao',
    'book' => 'pig',
    'game' => 'flight'
];
var_dump($arr1);
var_dump($arr2);
var_dump($arr1 + $arr2);
//var_dump(array_merge($arr1, $arr2));

// var_dump($arr3 + $arr4);
// var_dump(array_merge($arr3, $arr4));