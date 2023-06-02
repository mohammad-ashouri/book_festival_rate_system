<?php
include_once __DIR__.'/../../../config/connection.php';
session_start();
if (isset($_POST['postName']) and $_POST['postName']!=null and !empty($_POST['postName'])){
    $postName= $_POST['postName'];
    $postFormat=$_POST['postFormat'];
    $language=$_POST['language'];
    $postType=$_POST['postType'];
    $pagesNumber=$_POST['pagesNumber'];
    $specialSection=$_POST['specialSection'];
    $properties=$_POST['properties'];
    $research_type=$_POST['research_type'];
    $scientificGroup1=$_POST['scientificGroup1'];
    $activityType=$_POST['activityType'];
    $postDeliveryMethod=$_POST['postDeliveryMethod'];

    if ($postFormat=='کتاب'){
        $publisher=$_POST['publisher'];
        $ISSN=$_POST['ISSN'];
        $numberOfCovers=$_POST['numberOfCovers'];
        $circulation=$_POST['circulation'];
        $bookSize=$_POST['bookSize'];
    }elseif ($postFormat==='پایان نامه'){
        $thesisCertificateNumber = $_POST['thesisCertificateNumber'];
        $thesisDefencePlace = $_POST['thesisDefencePlace'];
        $thesisGrade = $_POST['thesisGrade'];
        $thesisSupervisor = $_POST['thesisSupervisor'];
        $thesisAdvisor = $_POST['thesisAdvisor'];
    }

    if ($research_type=='چند رشته ای'){
         $scientificGroup2 = $_POST['scientificGroup2'];
    }

    if ($activityType=='مشترک'){

    }

    if ($postDeliveryMethod=='digital'){

    }

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $national_code=$_POST['national_code'];
    $mobile=$_POST['mobile'];
    @$shparvandetahsili=$_POST['shparvandetahsili'];

}