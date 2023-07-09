<?php
include_once 'jdf.php';
include_once 'GDate.php';
//include_once 'PHPExcel/Classes/PHPExcel.php';
//ini_set('session.gc_maxlifetime', 36000);
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set("Asia/Tehran");
$main_url="https://localhost/";
$signup_url="https://localhost:8000/";
$year=jdate('Y');
$month=jdate('n');
$day=jdate('j');
$hour=jdate('H');
$min=jdate('i');
$sec=jdate('s');
$date=$year."/".$month."/".$day;
$datewithtime=$year."/".$month."/".$day.' '.$hour.":".$min.":".$sec;
$now = date('Y-m-d H:i:s');

$connection_book = @mysqli_connect('localhost', 'root', '', 'ssmp_bookfestival');
if (mysqli_connect_errno()) {
    echo 'ارتباط با دیتابیس دچار اختلال شده است. خطا به این صورت میباشد:' . mysqli_connect_error();
    exit();
}
mysqli_set_charset($connection_book, 'utf8');

$connection_book_signup = @mysqli_connect('localhost', 'root', '', 'book_festival_signup');
if (mysqli_connect_errno()) {
    echo 'ارتباط با دیتابیس دچار اختلال شده است. خطا به این صورت میباشد:' . mysqli_connect_error();
    exit();
}
mysqli_set_charset($connection_book_signup, 'utf8');

include_once __DIR__.'/../build/php/functions.php';