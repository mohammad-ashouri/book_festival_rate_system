<?php
include_once __DIR__ . '/../../../config/connection.php';
session_start();
if ($_SESSION['head'] == 3 or $_SESSION['head'] == 4) {
    $editor = $_SESSION['id'];
    $work = $_POST['work'];
    $postID = $_POST['postID'];
    $data = $_POST['data'];
    $now = date('Y-m-d H:i:s');

    if ($postID) {
        switch ($work) {
            case 'updateName':
                $query = mysqli_query($connection_book_signup, "update posts set title='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updatePostType':
                $query = mysqli_query($connection_book_signup, "update posts set post_type ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateLanguage':
                $query = mysqli_query($connection_book_signup, "update posts set language ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
        }
    }
}