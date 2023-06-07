<?php include_once __DIR__ . '/../../config/connection.php';
session_start();
if ($_SESSION['head'] == 4 or $_SESSION['head'] == 3) {
    $book_id = $_GET['id'];
    $book = mysqli_query($connection_book_signup, 'select * from posts where id=' . $book_id);
    foreach ($book as $bookInfo) {
    }
    $person=mysqli_query($connection_book_signup,"select * from users where id=".$bookInfo['user_id']);
    foreach ($person as $personInfo){}

    $contact=mysqli_query($connection_book_signup,"select * from contacts where national_code=".$personInfo['national_code']);
    foreach ($contact as $contactInfo){}

    $education=mysqli_query($connection_book_signup,"select * from educational_infos where national_code=".$personInfo['national_code']);
    foreach ($education as $educationInfo){}
    header('Content-Type: application/json');
    echo json_encode([
        'id'=>$bookInfo['id'],
        'postName' => $bookInfo['title'],
        'postFormat' => $bookInfo['post_format'],
        'postType' => $bookInfo['post_type'],
        'language' => $bookInfo['language'],
        'publisher' => $bookInfo['publisher'],
        'ISSN' => $bookInfo['ISSN'],
        'numberOfCovers' => $bookInfo['number_of_covers'],
        'circulation' => $bookInfo['circulation'],
        'bookSize' => $bookInfo['book_size'],
        'thesisCertificateNumber' => $bookInfo['thesis_certificate_number'],
        'thesisDefencePlace' => $bookInfo['thesis_defence_place'],
        'thesisGrade' => $bookInfo['thesis_grade'],
        'thesisSupervisor' => $bookInfo['thesis_supervisor'],
        'thesisAdvisor' => $bookInfo['thesis_advisor'],
        'pagesNumber' => $bookInfo['pages_number'],
        'specialSection' => $bookInfo['special_section'],
        'properties' => $bookInfo['properties'],
        'research_type' => $bookInfo['research_type'],
        'scientificGroup1' => $bookInfo['scientific_group_v1'],
        'scientificGroup2' => $bookInfo['scientific_group_v2'],

        'activityType'=>$bookInfo['activity_type'],

        'postDeliveryMethod' => $bookInfo['post_delivery_method'],
        'file_src' => $bookInfo['file_src'],
        'thesis_proceedings_src' => $bookInfo['thesis_proceedings_src'],

        'fName' => $personInfo['name'],
        'lName' => $personInfo['family'],
        'national_code' => $personInfo['national_code'],
        'gender' => $personInfo['gender'],
        'mobile' => $contactInfo['mobile'],
        'shparvandetahsili' => $educationInfo['shparvandetahsili'],
    ], JSON_THROW_ON_ERROR);}
?>