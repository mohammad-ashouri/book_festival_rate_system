<?php include_once __DIR__ . '/../../../config/connection.php'; ?>
<!DOCTYPE html>
<html>
<body>
<?php
session_start();
$raterCode = $_GET['raterCode'];
$postID = $_GET['postID'];
$registrar = $_SESSION['id'];
if ($_SESSION['head'] == 2 or $_SESSION['head'] == 3 or $_SESSION['head'] == 4) {
    $query=mysqli_query($connection_book,"select * from posts where id='$postID'");
    foreach ($query as $postInfo){}
    if ($postInfo['ejmali1_ratercode_g1']!=$raterCode and $postInfo['ejmali3_ratercode_g1']!=$raterCode) {
        $query = mysqli_query($connection_book, "update posts set ejmali2_ratercode_g1='$raterCode',ejmali2_registrar_g1='$registrar',ejmali2_set_date_g1='$datewithtime' where id='$postID'");
        $operation = "Set Post For Rater2 Group1";
        $urlofthispage = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        logsend($operation, $urlofthispage, $connection_book);
        $codeasar = null;
        $raterCode = null;
    }
}
mysqli_close($connection_book);
?>

</body>
</html>