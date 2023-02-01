<?php
include('IFNaiveBayes.php');

use AI\IFNaiveBayes as NB;

$training_data2 = json_decode(file_get_contents('training_data2.json'));
$success = 0;
$filed = 0;
for ($i = 0; $i < 100000; $i++) {
    $fisika = rand(0, 2);
    $b_inggris = rand(0, 2);
    $mtk = rand(0, 2);
    $psikotes = rand(0, 2);
    $interest = rand(0, 2);
    $data = [
        'fisika'    =>  $fisika,
        'b.inggris' =>  $b_inggris,
        'mtk'       =>  $mtk,
        'psikotes'  =>  $psikotes,
        'interest'  =>  $interest
    ];
    if (NB::process($data, $training_data2, null, true, false)) {
        $a[] = $data + ['label' => NB::get_result()];
        $b[NB::get_result()][] = $data;
        $success++;
    } else {
        $filed++;
    }
    NB::clear();
}

file_put_contents('test_data.json', json_encode($a));
file_put_contents('test_data2.json', json_encode($b));

unset($a);
unset($b);

echo "<pre>";
var_dump([
    'success'   =>  $success,
    'filed'     =>  $filed
]);
echo "</pre>";
die();
