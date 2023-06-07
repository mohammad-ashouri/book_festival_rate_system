<?php
include_once __DIR__ . '/../../config/connection.php';
session_start();
if ($_SESSION['head']==3 or $_SESSION['head']==4){
    $userID=$_GET['id'];
    $person=mysqli_query($connection_book_signup,"select * from users where id=".$userID);
    foreach ($person as $personInfo){}

    $contact=mysqli_query($connection_book_signup,"select * from contacts where national_code=".$personInfo['national_code']);
    foreach ($contact as $contactInfo){}

    $education=mysqli_query($connection_book_signup,"select * from educational_infos where national_code=".$personInfo['national_code']);
    foreach ($education as $educationInfo){}
    header('Content-Type: application/json');
    echo json_encode([
        'name'=>$personInfo['name'],
        'family'=>$personInfo['family'],
        'national_code'=>$personInfo['national_code'],
        'gender'=>$personInfo['gender'],
        'mobile'=>$contactInfo['mobile'],
        'shparvandetahsili'=>$educationInfo['shparvandetahsili']
    ], JSON_THROW_ON_ERROR);
}
session_abort();