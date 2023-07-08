<?php include_once __DIR__ . '/../../../config/connection.php'; ?>
<!DOCTYPE html>
<html>
<body>
<?php
session_start();
$coderater = $_GET['coderater'];
$postID = $_GET['postID'];
$registrar = $_SESSION['id'];

$query=mysqli_query($connection_book,"update posts set ejmali1_ratercode_g1='$coderater',ejmali1_registrar_g1='$registrar',ejmali1_set_date_g1='$datewithtime' where id='$postID'");

$codeasar = null;
$coderater = null;
mysqli_close($connection_book);
?>

</body>
</html>