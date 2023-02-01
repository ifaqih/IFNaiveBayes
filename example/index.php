<?php
include('../src/IFNaiveBayes.php');

use ifaqih\AIMethods\NaiveBayes as NB;

/*
| ===================================================================
|  EXAMPLE PROTOTYPE 1
| ===================================================================
| Set data by method
*/

$data = [
    'fisika'    =>  1,
    'b.inggris' =>  2,
    'mtk'       =>  1,
    'psikotes'  =>  2,
    'interest'  =>  0
];

$key_label = 'label';
$training_data = json_decode(file_get_contents('test_data.json'));
NB::set_data($data);
NB::set_training_data($training_data, NB_BY_ROWS, $key_label);
$start = microtime(true);
NB::process();
$end = microtime(true);
echo "Example Prototype 1";
echo "<pre>";
var_dump([
    'result'    =>  NB::get_result(),
    'point'     =>  NB::get_result_point(),
    'start_at'      =>  $start,
    'end_at'        =>  $end,
    'execution_time' =>  $end - $start
]);
echo "</pre>";
NB::clear();

/*
| ===================================================================
|  EXAMPLE PROTOTYPE 2
| ===================================================================
| Set data by parameters
*/

$training_data2 = json_decode(file_get_contents('test_data2.json'));
$clear_after_process = false;
$boolean_returned = false;
$key_label = null;
$start = microtime(true);
NB::process($data, $training_data2, NB_BY_GROUP_LABEL, $key_label, $boolean_returned, $clear_after_process);
$end = microtime(true);
echo "Example Prototype 2";
echo "<pre>";
var_dump([
    'result'        =>  NB::get_result(),
    'point'         =>  NB::get_result_point(),
    'start_at'      =>  $start,
    'end_at'        =>  $end,
    'execution_time' =>  $end - $start
]);
echo "</pre>";
NB::clear();

/*
| ===================================================================
|  EXAMPLE PROTOTYPE 3
| ===================================================================
| Set training data based on number of attributes and number of labels
*/
$training_data3 = [
    'TI'    =>  [
        'attributes'  =>  [
            'fisika'    =>  5774,
            'b.inggris' =>  12721,
            'mtk'       =>  14780,
            'psikotes'  =>  6942,
            'interest'  =>  17376
        ],
        'total'     =>  28410
    ],
    'TM'    =>  [
        'attributes'  =>  [
            'fisika'    =>  14299,
            'b.inggris' =>  7968,
            'mtk'       =>  5373,
            'psikotes'  =>  11432,
            'interest'  =>  8026
        ],
        'total'     =>  32757
    ],
    'TP'    =>  [
        'attributes'  =>  [
            'fisika'    =>  13227,
            'b.inggris' =>  12451,
            'mtk'       =>  13291,
            'psikotes'  =>  14748,
            'interest'  =>  7905
        ],
        'total'     =>  38833
    ]
];
NB::set_training_data($training_data3, NB_BY_NUMBER);
NB::set_data($data);
$start = microtime(true);
NB::process();
$end = microtime(true);
echo "Example Prototype 3";
echo "<pre>";
var_dump([
    'result'        =>  NB::get_result(),
    'point'         =>  NB::get_result_point(),
    'start_at'      =>  $start,
    'end_at'        =>  $end,
    'execution_time' =>  $end - $start
]);
echo "</pre>";
NB::clear();
