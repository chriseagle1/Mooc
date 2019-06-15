<?php
class Solution {

    /**
     */
    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @param Integer $k
     * @return Integer[]
     */
    public function maxNumber($nums1, $nums2, $k) {
        $len1 = count($nums1);
        $len2 = count($nums2);
        
        if ($k >= $len1 + $len2) { //如果返回长度大于两数组长度，这直接合并两数组，返回
            return $this->mergeNums($nums1, $nums2);
        }
        
        $maxArr = [];
        
        for ($i = 0; $i <= $len1; $i++) {//$i表示要在nums1中保留$i个数据
            if ($i > $k) {//如果$i 大于$k 直接结束
                break;
            } else if ($i + $len2 < $k) {//如果$i + $len2的长度小于$k，则不用计算，直接跳过
                continue;
            } else {
                $arr1 = $this->getMaxNum($nums1, $i);//从nums1中取出包含$i个数的最大值
                $arr2 = $this->getMaxNum($nums2, $k - $i);//从$nums1中取了$i个，则从nums2中取$k - $i 个
                $res = $this->mergeNums($arr1, $arr2); //将从$nums1和$nums2中取的数合并
                
                $maxArr = empty($maxArr) || ($this->compare($maxArr, $res) < 0) ? $res : $maxArr;//记录下最大的数据组合
            }
        }
        return $maxArr;
    }
    
    /**
     * 比较两个组中数的大小
     * @param array $arr1
     * @param array $arr2
     * @return number
     */
    public function compare($arr1, $arr2) {
        $len1 = count($arr1);
        $len2 = count($arr2);
        $i = 0;
        for (; $i < $len1; $i++) {//从前往后遍历，逐个比较
            if (!isset($arr2[$i]) || $arr1[$i] > $arr2[$i]) {//$arr1[$i] 比 $arr2[$i]大，或者$i超出了$arr2的长度。则arr1大
                return 1;
            } else if ($arr1[$i] < $arr2[$i]){
                return -1;
            }
        }
        if ($len2 > $i) {
            return -1;
        }
        return 0;
    }
    
    /**
     * 按现有顺序合并两个数组
     * @param array $arr1
     * @param array $arr2
     * @return array|unknown[]
     */
    public function mergeNums($arr1, $arr2) {
        $len1 = count($arr1);
        $len2 = count($arr2);
        $i = $j = 0;
        $res = [];
        while ($i < $len1 && $j < $len2) {//依次比较两个数组的元素大小，合并到结果数组
            if ($arr1[$i] >$arr2[$j]) {
                $res[] = $arr1[$i];
                $i++;
            } else if ($arr1[$i] < $arr2[$j]){
                $res[] = $arr2[$j];
                $j++;
            } else {
                  $compare = $this->compare(array_slice($arr1, $i), array_slice($arr2, $j));
                  
                  if ($compare >= 0) {
                      $res[] = $arr1[$i];
                      $i++;
                  } else {
                      $res[] = $arr2[$j];
                      $j++;
                  }
            }
        }
        
        if ($i < $len1) {//如果数组1未变量完，则追加到最后
            $res = array_merge($res, array_slice($arr1, $i));
        }
        
        if ($j < $len2) {//如果数组2未变量完，则追加到最后
            $res = array_merge($res, array_slice($arr2, $j));
        }
        return $res;
    }
    /**
     * 找到数组中最大的k位数
     * @param array $bucket
     * @param int $k
     * @return array|unknown
     */
    public function getMaxNum($bucket, $k) {
        if ($k == 0) { //如果需要取的个数为0， 则直接返回空数组
            return [];
        }
        $removeNum = count($bucket) - $k;//计算出需要从数组中移出的数据个数
        if ($removeNum <= 0) {//如果要返回的数据大于等于数组长度，返回整个数组
            return $bucket;
        }
        
        $arr = [];
        $i = -1;
        foreach ($bucket as $num) {//循环整个数组，移出数据，使让数据中大的数据尽量靠前
            while ($removeNum > 0 && $i >= 0 && $arr[$i] < $num)  {
                array_pop($arr);
                $i--;
                $removeNum--;
            }
            $arr[] = $num;
            $i++;
        }
        if ($removeNum > 0) {//如果循环完整个数组，还没有达到需要移出的个数，则从最后移出剩下需要移出的个数
            $arr = array_slice($arr, 0, count($arr) - $removeNum);
        }
        return $arr;
    }
}
$nums1 = [5,7,7,0,1,6,7,2,2,4,6,8,9,2,0,9,8,7,6,3,9,4,8,8,4,5,3,3,7,4,3,2,8,9,8,4,0,2,0,2,2,0,4,2,2,8,6,7,1,0,8,7,5,4,6,4,1,7,4,4,3,7,5,8,8,0,3,1,3,4,6,0,6,9,6,6,4,2,1,9,3,7,4,4,4,2,1,9,5,2,1,7,6,0,1,3,5,3,7,7];
$nums2 = [8,3,7,8,6,9,1,5,5,0,5,2,8,7,8,3,3,7,9,2];
$k = 100;

$obj = new Solution();
$res = $obj->maxNumber($nums1, $nums2, $k);
echo implode(',', $res);