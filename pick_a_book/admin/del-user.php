<?php
include('includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "delete from tblstudents where id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    header('location:reg-students.php');
}
?>