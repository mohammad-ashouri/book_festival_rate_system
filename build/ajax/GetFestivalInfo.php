<?php
include_once __DIR__ . '/../../config/connection.php';
session_start();
if ($_SESSION['head']==4){
    $persianName=$_GET['name'];
    $query=mysqli_query($connection_book_signup,"Select * from festivals where title='$persianName'");
    foreach ($query as $festivalInfo){}
    if (mysqli_num_rows($query) > 0) {
        echo 'این نام قابل ثبت نمی باشد.';
    }else{
        echo 'این نام قابل ثبت می باشد.';
    }
}
