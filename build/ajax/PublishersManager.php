<?php
include_once __DIR__ . '/../../config/connection.php';
session_start();
if ($_SESSION['head']==4 or $_SESSION['head']==3){
    echo $work = $_GET['work'];
    switch ($work) {
        case 'ActivePublishers':
            $query = mysqli_query($connection_book_signup, "select * from publishers where active=1 order by title");
            break;
        case 'DeactivePublishers':
            $query = mysqli_query($connection_book_signup, "select * from publishers where active=0 order by title");
            break;
    }
    foreach ($query as $publishers) {
        echo "<option value='" . $publishers['title'] . "'>" . $publishers['title'] . '</option>';
    }
}
?>
