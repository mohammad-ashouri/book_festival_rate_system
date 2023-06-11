<?php
include_once __DIR__ . '/../../config/connection.php';
session_start();
if ($_SESSION['head'] == 4 or $_SESSION['head'] == 3) {
    $work = $_REQUEST['work'];

    switch ($work) {
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
            $query = mysqli_query($connection_book_signup, "update publishers set title='$updatedValue' where id='$publisherID'");
            if ($query) {
                echo 'Done';
            }
            break;
    }
}
?>
