<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$id = $_GET['id'];
//untuk mengambil data mahasiswa.
$sql = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nrp='$id'");
//menyimpan data mahasiswa melalui mysql 
$d = mysqli_fetch_array($sql);
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
    <h3 class="text-center">Edit Data Mahasiswa</h3>
    <br />
    <a href="index.php" class="btn btn-info mb-3" style="margin-left: 50px;">Kembali</a>
    <br />
    <br />
    <form action="edit_aksi.php" method="POST" enctype="multipart/form-data" style="margin-left: 50px; margin-right: 50px;">
        <div class="mb-3">
            <label for="nrp" class="form-label">NRP</label>
            <input type="number" name="nrp" class="form-control" id="nrp" required value="<?php echo $d["nrp"]; ?>">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" required value="<?php echo $d["nama"]; ?>">
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" required value="<?php echo $d["jenis_kelamin"]; ?>">
        </div>
        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" id="jurusan" required value="<?php echo $d["jurusan"]; ?>">
        </div>
        <div class="mb-3">
            <label for="email_student" class="form-label">Email Student</label>
            <input type="text" class="form-control" name="email_student" id="email_student" required value="<?php echo $d["email_student"]; ?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required value="<?php echo $d["alamat"]; ?>">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="number" class="form-control" name="no_hp" id="no_hp" required value="<?php echo $d["no_hp"]; ?>">
        </div>
        <div class="mb-3">
            <label for="asal_sma" class="form-label">Asal SMA</label>
            <input type="text" class="form-control" name="asal_sma" id="asal_sma" required value="<?php echo $d["asal_sma"]; ?>">
        </div>
        <div class="mb-3">
            <label for="matkul_favorit" class="form-label">Mata Kuliah Favorit</label>
            <input type="text" class="form-control" name="matkul_favorit" id="matkul_favorit" required value="<?php echo $d["matkul_favorit"]; ?>">
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label> <br />
            <img id="gambar" src="berkas/<?= $d['gambar']; ?>" alt="Gambar Profil" style="max-width:100px"> <br/> <br/>
            <input type="file" class="form-control" name="gambar" id="gambar">
        </div>
        <div class="col-12">
            <button type="submit" value="Simpan" name="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        })
    </script>
</body>

</html>