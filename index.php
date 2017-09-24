<?php
use MyDate\MyDate;

require 'MyDate.php';

$s = new DateTime('2017-09-22');
$e = new DateTime('2018-11-13');
$dv = new DateInterval('P1D');

$mydate = new MyDate($s, $e, $dv);

header('Content-type: text/plain; charset=utf-8');

timer(1);
$list = $mydate->getList();
//print_r($list);
echo timer()."\n";

timer(1);
$list = $mydate->getList2();
//print_r($list);
echo timer()."\n";

timer(1);
foreach ($mydate as $key => $val) {
    //printf("%3d: %s\n", $key, $val);
}
echo timer()."\n";

function timer($reset=false)
{
    static $mtime = 0;
    if ($reset) {
        $mtime = 0;
    }
    $time = microtime(1);
    if (!$mtime) {
        $diff = 0;
    } else {
        $diff = $time - $mtime;
    }
    $mtime = $time;
    return round($diff * 1000, 1);
}
