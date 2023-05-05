<?php
include 'koneksi.php';

//menangkap data yang dikirim dari form
$nrp = $_POST['nrp'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$jurusan = $_POST['jurusan'];
$email_student = $_POST['email_student'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$asal_sma = $_POST['asal_sma'];
$matkul_favorit = $_POST['matkul_favorit'];

if(isset($_POST['submit'])){
    $ekstensi_diperbolehkan	= array('png','jpg','jpeg', 'pdf');
    $namegambar = $_FILES['gambar']['name'];
    $x = explode('.', $namegambar);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];	

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 2000000){			
            move_uploaded_file($file_tmp, 'berkas/'.$namegambar);
        }else{
            echo 'UKURAN FILE TERLALU BESAR';
        }
    }else{
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }
}

//menginput data ke database
$query = mysqli_query($conn,"insert into mahasiswa values('','$nrp','$nama','$jenis_kelamin','$jurusan','$email_student','$alamat','$no_hp','$asal_sma','$matkul_favorit', '$namegambar')");
if($query){
    echo 'gambar berhasil diupload';
}else{
    echo 'GAGAL MENGUPLOAD GAMBAR';
}
 
//mengalihkan halaman kembali ke index.php
header("location:index.php");

?>
