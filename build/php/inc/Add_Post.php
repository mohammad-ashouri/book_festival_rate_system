<?php
include_once __DIR__ . '/../../../config/connection.php';
session_start();
//if (isset($_POST['postName']) and $_POST['postName']!=null and !empty($_POST['postName'])){
//    $postName= $_POST['postName'];
//    $postFormat=$_POST['postFormat'];
//    $language=$_POST['language'];
//    $postType=$_POST['postType'];
//    $pagesNumber=$_POST['pagesNumber'];
//    $specialSection=$_POST['specialSection'];
//    $properties=$_POST['properties'];
//    $research_type=$_POST['research_type'];
//    $scientificGroup1=$_POST['scientificGroup1'];
//    $activityType=$_POST['activityType'];
//    $postDeliveryMethod=$_POST['postDeliveryMethod'];
//
//    if ($postFormat=='کتاب'){
//        $publisher=$_POST['publisher'];
//        $ISSN=$_POST['ISSN'];
//        $numberOfCovers=$_POST['numberOfCovers'];
//        $circulation=$_POST['circulation'];
//        $bookSize=$_POST['bookSize'];
//    }elseif ($postFormat==='پایان نامه'){
//        $thesisCertificateNumber = $_POST['thesisCertificateNumber'];
//        $thesisDefencePlace = $_POST['thesisDefencePlace'];
//        $thesisGrade = $_POST['thesisGrade'];
//        $thesisSupervisor = $_POST['thesisSupervisor'];
//        $thesisAdvisor = $_POST['thesisAdvisor'];
//    }
//
//    if ($research_type=='چند رشته ای'){
//         $scientificGroup2 = $_POST['scientificGroup2'];
//    }
//
//    if ($activityType=='مشترک'){
//
//    }
//
//    if ($postDeliveryMethod=='digital'){
//
//    }
//
//    $fname=$_POST['fname'];
//    $lname=$_POST['lname'];
//    $national_code=$_POST['national_code'];
//    $mobile=$_POST['mobile'];
//    @$shparvandetahsili=$_POST['shparvandetahsili'];
//
//}
if (isset($_FILES['post_file'])) {
    $postFile_size = $_FILES['post_file']['size'];
    $postFile_name = $_FILES['post_file']['name'];
    $postFile_type = $_FILES['post_file']['type'];
    $postFile_tmpname = $_FILES["post_file"]["tmp_name"];
    $bytes = random_bytes(20);
    $encodedString = bin2hex($bytes);
    $directory = __DIR__ . "/../../../Files/" . $encodedString . $postFile_name;
    if (!mkdir($directory, 0777, true) && !is_dir($directory)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
    }
    move_uploaded_file($postFile_tmpname, $directory . '/' . $postFile_name);
} else {
    echo "خطا در دریافت فایل اثر.";
}

if (isset($_FILES['proceedings_file'])) {
    $proceedings_file_size = $_FILES['proceedings_file']['size'];
    $proceedings_file_name = $_FILES['proceedings_file']['name'];
    $proceedings_file_type = $_FILES['proceedings_file']['type'];
    $proceedings_file_tmpname = $_FILES["proceedings_file"]["tmp_name"];
    $bytes = random_bytes(20);
    $encodedString = bin2hex($bytes);
    $directory = __DIR__ . "/../../../Files/" . $encodedString . $proceedings_file_name;
    if (!mkdir($directory, 0777, true) && !is_dir($directory)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
    }
    move_uploaded_file($proceedings_file_tmpname, $directory . '/' . $proceedings_file_name);
} else {
    echo "خطا در دریافت فایل صورتجلسه.";
}