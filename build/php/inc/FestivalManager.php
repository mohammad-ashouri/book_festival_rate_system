<?php
include_once __DIR__ . '/../../../config/connection.php';
session_start();
if ($_SESSION['head'] == 4) {
    $work = $_POST['work'];
    $user = $_SESSION['id'];
    switch ($work) {
        case 'Finish_Festival':
            $query = mysqli_query($connection_book_signup, "update festivals set active=0,finish_date='$datewithtime',finisher='$user',updated_at='$now'");
            if ($query) {
                echo 'Done';
            }
            break;
        case 'New_Festival':
            $registrar = $_SESSION['id'];
            $QueryForCheckPassword = mysqli_query($connection_book, "select * from users where id='$registrar' and type=4");
            foreach ($QueryForCheckPassword as $Passworditem) {
            }
            if ($Passworditem) {
                $userPassword = $Passworditem['password'];
                $inputPassword = $_POST['password'];
                if (!password_verify($inputPassword, $userPassword)) {
                    echo 'WrongPassword';
                } else {
                    $festival_name=$_POST['festivalName'];
                    $start_date=$_POST['startDate'];
                    $QueryForCheckFestivalExists = mysqli_query($connection_book_signup, "select * from festivals where title ='$festival_name'");
                    foreach ($QueryForCheckFestivalExists as $Festivalitem) {
                    }
                    if (!@$Festivalitem){
                        mysqli_query($connection_book_signup,"update festivals set active=0,finisher='$user',finish_date='$datewithtime',updated_at='$now' where active=1");
                        $query=mysqli_query($connection_book_signup,"insert into festivals (title,start_date,starter,created_at) values ('$festival_name','$start_date','$user','$now')");
                        if ($query){
                            echo 'Done';
                        }
                    }else{
                        echo 'FestivalNameExists';
                    }
                }
            }

            break;
    }
}