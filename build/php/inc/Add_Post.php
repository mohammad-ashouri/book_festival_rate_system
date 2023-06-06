<?php
include_once __DIR__ . '/../../../config/connection.php';
session_start();
if (isset($_POST['postName']) and $_POST['postName'] != null and !empty($_POST['postName']) and isset($_SESSION['id'])) {
    $registrar=$_SESSION['id'];
    $postName = $_POST['postName'];
    $postFormat = $_POST['postFormat'];
    $language = $_POST['language'];
    $postType = $_POST['postType'];
    $pagesNumber = $_POST['pagesNumber'];
    $specialSection = $_POST['specialSection'];
    $properties = $_POST['properties'];
    $research_type = $_POST['research_type'];
    $scientificGroup1 = $_POST['scientificGroup1'];
    $activityType = $_POST['activityType'];
    $postDeliveryMethod = $_POST['postDeliveryMethod'];

    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $national_code = $_POST['national_code'];
    $mobile = $_POST['mobile'];
    @$shparvandetahsili = $_POST['shparvandetahsili'];
    $gender = $_POST['gender'];
    date_default_timezone_set('Asia/Tehran');
    $now = date('Y-m-d H:i:s');

    $checkIfUserExists = mysqli_query($connection_book_signup, "select * from users where national_code='$national_code'");
    foreach ($checkIfUserExists as $checkUser) {
    }

    if (@$checkUser == null) {
        mysqli_query($connection_book_signup, "insert into users (name, family, national_code, gender, created_at) values ('$fname','$lname','$national_code','$gender','$now')");
        $insertContact = mysqli_query($connection_book_signup, "insert into contacts (national_code,mobile,created_at) values ('$national_code','$mobile','$now')");
        $insertEducational = mysqli_query($connection_book_signup, "insert into educational_infos (national_code,shparvandetahsili,created_at) values ('$national_code','$shparvandetahsili','$now')");
    }

    $query = mysqli_query($connection_book_signup, "select * from users where national_code='$national_code'");
    foreach ($query as $userInfo) {
    }

    $userID = $userInfo['id'];

    $query = mysqli_query($connection_book_signup, "select * from festivals where active=1");
    foreach ($query as $festivalInfo) {
    }

    $festival_id = $festivalInfo['id'];

    $insertPost = mysqli_query($connection_book_signup, "insert into posts (user_id,festival_id,title,post_format,post_type,language,pages_number,special_section,properties,research_type,scientific_group_v1,activity_type,post_delivery_method,created_at) values
                                                                           ('$userID','$festival_id','$postName','$postFormat','$postType','$language','$pagesNumber',null,'$properties','$research_type','$scientificGroup1','$activityType','$postDeliveryMethod','$now')");
    if ($insertPost) {
        $lastInsertedId = mysqli_insert_id($connection_book_signup);
        if ($research_type == 'چند رشته ای') {
            $scientificGroup2 = $_POST['scientificGroup2'];
            mysqli_query($connection_book_signup, "update posts set scientific_group_v2='$scientificGroup2' where id='$lastInsertedId'");
        }

        if ($activityType == 'مشترک') {
            $coopPerSum = 0;
            $postData = $_POST['postData'];
            foreach ($postData as $post) {
                $data = json_decode($post);
                $coopName = $data->coopName;
                if ($coopName != null and $coopName != '' and !empty($coopName)) {
                    $coopFamily = $data->coopFamily;
                    $coopNationalCode = $data->coopNationalCode;
                    $coopPer = $data->coopPer;
                    $coopMobile = $data->coopMobile;
                    mysqli_query($connection_book_signup, "insert into participants (post_id, name, family, national_code, participation_percentage, mobile, created_at)
                                                                                    values ('$lastInsertedId','$coopName','$coopFamily','$coopNationalCode','$coopPer','$coopMobile','$now')");
                    $coopPerSum += $coopPer;
                }
            }
            $coopPerSum = 100 - $coopPerSum;
            mysqli_query($connection_book_signup, "update posts set participation_percentage ='$coopPerSum' where id='$lastInsertedId'");
        }

        if ($postFormat == 'کتاب') {
            $publisher = $_POST['publisher'];
            $ISSN = $_POST['ISSN'];
            $numberOfCovers = $_POST['numberOfCovers'];
            $circulation = $_POST['circulation'];
            $bookSize = $_POST['bookSize'];
            mysqli_query($connection_book_signup, "update posts set publisher='$publisher',ISSN='$ISSN',publish_status='منتشر شده',number_of_covers='$numberOfCovers',book_size='$bookSize',circulation='$circulation' where id='$lastInsertedId'");
        } elseif ($postFormat === 'پایان نامه') {
            $thesisCertificateNumber = $_POST['thesisCertificateNumber'];
            $thesisDefencePlace = $_POST['thesisDefencePlace'];
            $thesisGrade = $_POST['thesisGrade'];
            $thesisSupervisor = $_POST['thesisSupervisor'];
            $thesisAdvisor = $_POST['thesisAdvisor'];
            mysqli_query($connection_book_signup, "update posts set thesis_certificate_number='$thesisCertificateNumber',thesis_defence_place='$thesisDefencePlace',thesis_grade='$thesisGrade',thesis_supervisor='$thesisSupervisor',thesis_advisor='$thesisAdvisor' where id='$lastInsertedId'");
        }

        if ($postDeliveryMethod == 'digital') {
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
                $postFileDirectory = "Files/" . $encodedString . $postFile_name . '/' . $postFile_name;
                mysqli_query($connection_book_signup, "update posts set file_src='$postFileDirectory',post_delivery_method='نسخه دیجیتال' where id='$lastInsertedId'");
            } else {
                echo "خطا در دریافت فایل اثر.";
            }
            if ($postFormat == 'پایان نامه') {
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
                    $proceedingsFileDirectory = "Files/" . $encodedString . $proceedings_file_name . '/' . $proceedings_file_name;
                    mysqli_query($connection_book_signup, "update posts set thesis_proceedings_src='$proceedingsFileDirectory' where id='$lastInsertedId'");
                } else {
                    echo "خطا در دریافت فایل صورتجلسه.";
                }
            }
        } else {
            mysqli_query($connection_book_signup, "update posts set post_delivery_method='نسخه فیزیکی' where id='$lastInsertedId'");
        }

        mysqli_query($connection_book, "insert into posts (post_id,festival_id,adder,date_added) values ('$lastInsertedId','$festival_id','$registrar','$datewithtime')");
    }

}


