<?php
include_once __DIR__ . '/../../../config/connection.php';
ini_set('display_errors', 1);
session_start();
if ($_SESSION['head'] == 5 or $_SESSION['head'] == 4 or $_SESSION['head'] == 3) {
    $work = @$_POST['work'];
    if ($work) {
        $postID = $_POST['postID'];
        switch ($work) {
            case 'sortG1':
                $groupName = $_POST['groupName'];
                $query = mysqli_query($connection_book_signup, "update posts set scientific_group_v1='$groupName' where id='$postID' and sorted=0");
                if (!$query) {
                    echo 'Err';
                }
                break;
            case 'sortG2':
                $groupName = $_POST['groupName'];
                $query = mysqli_query($connection_book_signup, "select * from posts where id=" . $postID);
                foreach ($query as $checkG1) {
                }
                if ($checkG1['scientific_group_v1'] == $groupName) {
                    echo 'EqualGroups';
                } else {
                    if ($groupName == null or $groupName == '' or $groupName == 'بدون گروه دوم' or $groupName == 'بدون گروه') {
                        $query = mysqli_query($connection_book_signup, "update posts set scientific_group_v2=null,research_type='تک رشته ای' where id='$postID' and sorted=0");
                    } else {
                        $query = mysqli_query($connection_book_signup, "update posts set scientific_group_v2='$groupName',research_type='چند رشته ای' where id='$postID' and sorted=0");
                    }
                    if (!$query) {
                        echo 'Err';
                    }
                }
                break;
            case 'approveSort':
                $user = $_SESSION['id'];
                $query = mysqli_query($connection_book_signup, "update posts set sorted=1,sorter='$user',sorted_date='$now' where sorted=0 and id=" . $postID);
                if (!$query) {
                    echo 'Err';
                }
                break;
        }
    } elseif (isset($_FILES['SortingClassificationFile'])) {
        $user = $_SESSION['id'];
        $SortingClassificationFile_size = $_FILES['SortingClassificationFile']['size'];
        $SortingClassificationFile_name = $_FILES['SortingClassificationFile']['name'];
        $SortingClassificationFile_type = $_FILES['SortingClassificationFile']['type'];
        $SortingClassificationFile_tmpname = $_FILES["SortingClassificationFile"]["tmp_name"];
        $bytes = random_bytes(20);
        $encodedString = bin2hex($bytes);
        $directory = __DIR__ . "/../../../Files/Proceedings_Files/Sorting/" . $encodedString . $SortingClassificationFile_name;
        if (!mkdir($directory, 0777, true) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        move_uploaded_file($SortingClassificationFile_tmpname, $directory . '/' . $SortingClassificationFile_name);
        $postFileDirectory = "Files/Proceedings_Files/Sorting/" . $encodedString . $SortingClassificationFile_name . '/' . $SortingClassificationFile_name;

        $query = mysqli_query($connection_book, "insert into sorting_classifications (file_name, src, adder, added_date) values ('$SortingClassificationFile_name','$postFileDirectory','$user','$datewithtime')");
        if ($query) {
            $lastInsertID = mysqli_insert_id($connection_book);
            $query = mysqli_query($connection_book_signup, "select * from posts where sorted=1 and sorting_classification_id is null");
            foreach ($query as $notSortedPosts) {
                $postID = $notSortedPosts['id'];
                mysqli_query($connection_book, "update posts set rate_status='اجمالی' where post_id='$postID'");
            }
            mysqli_query($connection_book_signup, "update posts set sorting_classification_id='$lastInsertID' where sorted=1 and (sorting_classification_id is null or sorting_classification_id='')");
            echo 'Done';
        } else {
            echo "ErrorForSubmittingFile";
        }
    }
}