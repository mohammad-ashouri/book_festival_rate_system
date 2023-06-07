<?php
include_once __DIR__.'/../../../config/connection.php';
session_start();
if ($_SESSION['head']==3 or $_SESSION['head']==4) {
    $editor = $_SESSION['id'];
    $work=$_POST['work'];
    $postID=$_POST['postID'];
    $data=$_POST['data'];
    switch ($work){
        case 'updateName':
            $query=mysqli_query($connection_book_signup,"update posts set title='$data' where id='$postID'");
            if ($query){
                echo 'Done';
            }
            break;
    }
}