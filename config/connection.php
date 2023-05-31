<?php
include_once 'jdf.php';
include_once 'GDate.php';
//include_once 'PHPExcel/Classes/PHPExcel.php';
//ini_set('session.gc_maxlifetime', 36000);
date_default_timezone_set("Asia/Tehran");
$main_url="https://localhost/";
$year=jdate('Y');
$month=jdate('n');
$day=jdate('j');
$hour=jdate('H');
$min=jdate('i');
$sec=jdate('s');
$date=$year."/".$month."/".$day;
$datewithtime=$year."/".$month."/".$day.' '.$hour.":".$min.":".$sec;

$connection_book = @mysqli_connect('localhost', 'root', '', 'ssmp_bookfestival');
if (mysqli_connect_errno()) {
    echo 'ارتباط با دیتابیس دچار اختلال شده است. خطا به این صورت میباشد:' . mysqli_connect_error();
    exit();
}
mysqli_set_charset($connection_book, 'utf8');

$connection_book_signup = @mysqli_connect('localhost', 'root', '', 'book_festival');
if (mysqli_connect_errno()) {
    echo 'ارتباط با دیتابیس دچار اختلال شده است. خطا به این صورت میباشد:' . mysqli_connect_error();
    exit();
}
mysqli_set_charset($connection_book_signup, 'utf8');
//$conn = "";
//
//try {
//    $servername = "localhost";
//    $dbname = "pooyagra_helli-info";
//    $username = "pooyagra_adminhelli";
//    $password = "Mohammad1377";
//
//    $conn = new PDO(
//        "mysql:host=$servername; dbname=$dbname",
//        $username, $password
//    );
//
//    $conn->setAttribute(PDO::ATTR_ERRMODE,
//        PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo "Connection failed: " . $e->getMessage();
//}
//
