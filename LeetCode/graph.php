<?php
$graph = [
    'start' => [
        'A' => 5,
        'B' => 2
    ],
    'A' => [
        'C' => 4,
        'D' => 2
    ],
    'B' => [
        'A' => 8,
        'D' => 7
    ],
    'C' => [
        'end' => 1,
        'D' => 6
    ],
    'D' => [
        'end' => 1,
    ],
    'end' => [
    ]
];
$graph = [
    'start' => [
        'A' => 10
    ],
    'A' => [
        'B' => '20'
    ],
    'B' => [
        'C' => 1,
        'end' => 30
    ],
    'C' => [
        'A' => 1
    ],
    'end' => [
        
    ]
];

$result = Dijkstra($graph);
var_dump($result);

//获取权重花销列表
function getCosts($graph, $start) {
    if (!isset($graph[$start])) {
        return [];
    }
    
    $costs = $graph[$start];
   
    foreach ($graph as $key => $map) {
        if(!isset($costs[$key]) && $key != $start) {
            $costs[$key] = PHP_INT_MAX;
        }
    }
    return $costs;
}
//获取当前未处理的最便宜路径
function getLowestNode($costs, $processed) {
    $lowestCost = PHP_INT_MAX;
    $lowestNode = '';
    foreach ($costs as $node => $cost) {
        if (!in_array($node, $processed) && $cost < $lowestCost) {
            $lowestCost = $cost;
            $lowestNode = $node;
        }
    }
    return $lowestNode;
}

//迪杰斯特拉算法
function Dijkstra($graph) {
    $costs = getCosts($graph, 'start');
    $parents = [
        'A' => 'start', 'B' => 'start'
    ];
    $processed = [];
    $node = getLowestNode($costs, $processed);
    
    while ($node && isset($graph[$node])) {
        $neighbors = $graph[$node];
        foreach ($neighbors as $nbs => $cos) {
            $newCost = $costs[$node] + $cos;
            if ($newCost < $costs[$nbs]) {
                $costs[$nbs] = $newCost;
                $parents[$nbs] = $node;
            }
        }
        $processed[] = $node;
        $node = getLowestNode($costs, $processed);
    }
    
    return [
        'cost' => $costs['end'],
        'path' => getPath($parents, 'end')
    ];
}

//获取最短路径
function getPath($parents, $startKey) {
    $key = $startKey;
    $path = [];
    while (isset($parents[$key])) {
        array_unshift($path, $key);
        $key = $parents[$key];
    }
    array_unshift($path, $key);
    return implode('->', $path);
}