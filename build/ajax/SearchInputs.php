<?php
include_once __DIR__ . '/../../config/connection.php';
session_start();
if (isset($_SESSION['head'])){
    $work=$_POST['work'];
    switch ($work){
        case 'thesisCertificateNumberCheck':
            $data=$_POST['data'];
            $query=mysqli_query($connection_book_signup,"select * from posts where post_format='پایان نامه' and thesis_certificate_number='$data'");
            foreach ($query as $thesises){}
            if ($thesises){
                echo 'Wrong';
            }
            break;
    }

}
