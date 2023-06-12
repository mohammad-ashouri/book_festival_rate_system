<?php
include_once __DIR__ . '/../../config/connection.php';
session_start();
if ($_SESSION['head'] == 4 or $_SESSION['head'] == 3) {
    $work = $_REQUEST['work'];
    switch ($work) {
        case 'AllPublishers':
            $query = mysqli_query($connection_book_signup, "select * from publishers order by title");
            foreach ($query as $publishers) {
                echo "<option value='" . $publishers['id'] . "'>" . $publishers['title'] . '</option>';
            }
            break;
        case 'ActivePublishers':
            $query = mysqli_query($connection_book_signup, "select * from publishers where active=1 order by title");
            foreach ($query as $publishers) {
                echo "<option value='" . $publishers['id'] . "'>" . $publishers['title'] . '</option>';
            }
            break;
        case 'DeactivePublishers':
            $query = mysqli_query($connection_book_signup, "select * from publishers where active=0 order by title");
            foreach ($query as $publishers) {
                echo "<option value='" . $publishers['id'] . "'>" . $publishers['title'] . '</option>';
            }
            break;
        case 'updatePublisher':
            $publisherID = $_REQUEST['data']['id'];
            $updatedValue = $_REQUEST['data']['editedValue'];
            $query = mysqli_query($connection_book_signup, "update publishers set title='$updatedValue',updated_at='$now' where id='$publisherID'");
            if ($query) {
                echo 'Done';
            }
            break;
        case 'addPublisher':
            $publisherName = $_REQUEST['data'];
            if ($publisherName) {
                $user = $_SESSION['id'];
                $query = mysqli_query($connection_book_signup, "insert into publishers (title, user, active, created_at) values ('$publisherName','$user',1,'$now')");
                if ($query) {
                    echo 'Done';
                }
            } else {
                echo 'NullName';
            }
            break;
        case 'checkPublisher':
            $publisherName = $_REQUEST['data'];
            $query = mysqli_query($connection_book_signup, "Select * from publishers where title='$publisherName'");
            if (mysqli_num_rows($query) > 0) {
                echo 'FindedDouble';
            } else {
                echo 'Approve';
            }
            break;
        case 'deactivePublisher':
            $publisherID = $_REQUEST['data'];
            $query = mysqli_query($connection_book_signup, "update publishers set active=0,updated_at='$now' where id='$publisherID' and active=1");
            if ($query) {
                echo 'Done';
            }
            break;
        case 'activePublisher':
            $publisherID = $_REQUEST['data'];
            $query = mysqli_query($connection_book_signup, "update publishers set active=1,updated_at='$now' where id='$publisherID' and active=0");
            if ($query) {
                echo 'Done';
            }
            break;
    }
}
?>