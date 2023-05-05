<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP dan MySQLi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>
    <h3 style="text-center; margin-left: 50px;">Input Data Mahasiswa</h3> <br/>
    <a href="index.php" class="btn btn-info mb-3" style="margin-left: 50px;">Kembali</a> <br/>
    <form method="post" action="tambah_aksi.php" enctype="multipart/form-data" style="margin-left: 50px; margin-right: 50px;">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">NRP</label>
            <input type="number" class="form-control" name="nrp" placeholder="Masukkan NRP" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" name="jenis_kelamin" placeholder="Masukkan Jenis Kelamin" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" placeholder="Masukkan Jurusan" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Email Student</label>
            <input type="text" class="form-control" name="email_student" placeholder="Masukkan Email Student" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">No HP</label>
            <input type="number" class="form-control" name="no_hp" placeholder="Masukkan Nomor HP" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Asal SMA</label>
            <input type="text" class="form-control" name="asal_sma" placeholder="Masukkan Asal SMA" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Mata Kuliah Favorit</label>
            <input type="text" class="form-control" name="matkul_favorit" placeholder="Masukkan Mata Kuliah Favorit" >
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Upload Gambar</label>
            <input type="file" class="form-control" name="gambar">
        </div>
        <div class="col-12">
            <button type="submit" value="Simpan" name="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.table').DataTable();
        })
    </script>
    </div>

</body>
</html>