<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';



if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryshow = "SELECT * FROM mahasiswa WHERE nrp='$id'";
    $sqlshow = mysqli_query($conn, $queryshow);
    $result = mysqli_fetch_assoc($sqlshow);
    
    unlink("berkas/".$result['gambar']);
    

    $query = "DELETE FROM mahasiswa WHERE nrp='$id'";
    $sql = mysqli_query($conn, $query);

    if($sql) {
        header("Location:index.php");
    } else {
        echo $query;
    }
}

?>