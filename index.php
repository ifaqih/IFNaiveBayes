<?php
include('IFNaiveBayes.php');

use AI\IFNaiveBayes as NB;

/*
| ===================================================================
|  EXAMPLE 1
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
NB::set_training_data($training_data, $key_label);
$start = microtime(true);
NB::process();
$end = microtime(true) - $start;
echo "<pre>";
var_dump([
    'result'    =>  NB::get_result(),
    'point'     =>  NB::get_result_point(),
    'time'      =>  $end
]);
echo "</pre>";
NB::clear();

/*
| ===================================================================
|  EXAMPLE 2
| ===================================================================
| Set data by parameters
*/

$training_data2 = json_decode(file_get_contents('test_data2.json'));
$clear_after_process = false;
$boolean_returned = false;
$key_label = null;
$start1 = microtime(true);
NB::process($data, $training_data2, $key_label, $boolean_returned, $clear_after_process);
$end1 = microtime(true) - $start1;
echo "<pre>";
var_dump([
    'result'        =>  NB::get_result(),
    'point'         =>  NB::get_result_point(),
    'time'          =>  $end1
]);
echo "</pre>";
