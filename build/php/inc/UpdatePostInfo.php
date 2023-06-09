<?php
include_once __DIR__ . '/../../../config/connection.php';
session_start();
if ($_SESSION['head'] == 3 or $_SESSION['head'] == 4) {
    $editor = $_SESSION['id'];
    $work = $_POST['work'];
    $postID = $_POST['postID'];
    $data = $_POST['data'];
    $query = mysqli_query($connection_book_signup, "select * from posts where id='$postID'");
    foreach ($query as $postInfo) {
    }

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
            case 'updatePublisher':
                $query = mysqli_query($connection_book_signup, "update posts set publisher ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'ISSNForEdit':
                $query = mysqli_query($connection_book_signup, "update posts set ISSN ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateNumberOfCovers':
                $query = mysqli_query($connection_book_signup, "update posts set number_of_covers ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateCirculation':
                $query = mysqli_query($connection_book_signup, "update posts set circulation ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateBookSize':
                $query = mysqli_query($connection_book_signup, "update posts set book_size ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateThesisCertificateNumber':
                $query = mysqli_query($connection_book_signup, "update posts set thesis_certificate_number ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateThesisDefencePlace':
                $query = mysqli_query($connection_book_signup, "update posts set thesis_defence_place ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateThesisGrade':
                $query = mysqli_query($connection_book_signup, "update posts set thesis_grade ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateThesisSupervisor':
                $query = mysqli_query($connection_book_signup, "update posts set thesis_supervisor ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateThesisAdvisor':
                $query = mysqli_query($connection_book_signup, "update posts set thesis_advisor ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateThesisReferee':
                $query = mysqli_query($connection_book_signup, "update posts set thesis_referee ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updatePagesNumber':
                $query = mysqli_query($connection_book_signup, "update posts set pages_number ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateSpecialSection':
                $query = mysqli_query($connection_book_signup, "update posts set special_section ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateProperties':
                $query = mysqli_query($connection_book_signup, "update posts set properties ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateResearchType':
                if ($data == 'تک رشته ای') {
                    $query = mysqli_query($connection_book_signup, "update posts set scientific_group_v2 =null,updated_at='$now' where id='$postID'");
                }
                $query2 = mysqli_query($connection_book_signup, "update posts set research_type ='$data',updated_at='$now' where id='$postID'");
                if ($query2) {
                    echo 'Done';
                }
                break;
            case 'updateScientificGroup1':
                $query = mysqli_query($connection_book_signup, "update posts set scientific_group_v1 ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateScientificGroup2':
                $query = mysqli_query($connection_book_signup, "update posts set research_type='چند رشته ای',scientific_group_v2 ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateActivityType':
                $query = mysqli_query($connection_book_signup, "update posts set activity_type ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updatePostDeliveryMethod':
                $query = mysqli_query($connection_book_signup, "update posts set post_delivery_method ='$data',updated_at='$now' where id='$postID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateFName':
                $userID = $postInfo['user_id'];
                $query = mysqli_query($connection_book_signup, "update users set name='$data',updated_at='$now' where id='$userID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateLName':
                $userID = $postInfo['user_id'];
                $query = mysqli_query($connection_book_signup, "update users set family='$data',updated_at='$now' where id='$userID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateMobile':
                $userID = $postInfo['user_id'];
                $query = mysqli_query($connection_book_signup, "select * from users where id='$userID'");
                foreach ($query as $UserInfo) {
                }
                $national_code = $UserInfo['national_code'];

                $query = mysqli_query($connection_book_signup, "update contacts set mobile='$data',updated_at='$now' where national_code='$national_code'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateGender':
                $userID = $postInfo['user_id'];
                $query = mysqli_query($connection_book_signup, "update users set gender='$data',updated_at='$now' where id='$userID'");
                if ($query) {
                    echo 'Done';
                }
                break;
            case 'updateshparvandetahsili':
                $userID = $postInfo['user_id'];
                $query = mysqli_query($connection_book_signup, "select * from users where id='$userID'");
                foreach ($query as $UserInfo) {
                }
                $national_code = $UserInfo['national_code'];

                $query = mysqli_query($connection_book_signup, "update educational_infos set shparvandetahsili='$data',updated_at='$now' where national_code='$national_code'");
                if ($query) {
                    echo 'Done';
                }
                break;

        }
    }
}