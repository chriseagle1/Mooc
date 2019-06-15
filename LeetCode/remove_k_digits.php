<?php
class Solution {
    
    /**
     * @param String $num
     * @param Integer $k
     * @return String
     */
    function removeKdigits($num, $k) {
        if($k == 0) {
            return $num;
        }
        $len = strlen($num);
        $stack = new SplStack();
        
        for ($i = 0; $i < $len; $i++) {
            while ($k > 0 && !$stack->isEmpty() && $stack->top() > $num[$i]) {
                $k--;
                $stack->pop();
            }
            $stack->push($num[$i]);
        }
        $arr = [];
        while (!$stack->isEmpty() && $stack->bottom() == 0) {
            $stack->shift();
        }
        
        
        if ($stack->count() > $k) {
            $stack->
            $arr = array_slice($arr, 0, count($arr) - $k);
            return implode('', $arr);
        } else {
            return '0';
        }
    }
}
$num = '10200';
$k = 1;
$obj = new Solution();
echo $obj->removeKdigits($num, $k);