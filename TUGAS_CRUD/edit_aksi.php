<?php
include 'koneksi.php';

//menangkap data yang dikirim dari form
$nrp = ($_POST["nrp"]);
$nama = ($_POST["nama"]);
$jenis_kelamin = ($_POST["jenis_kelamin"]);
$jurusan = ($_POST["jurusan"]);
$email_student = ($_POST["email_student"]);
$alamat = ($_POST["alamat"]);
$no_hp = ($_POST["no_hp"]);
$asal_sma = ($_POST["asal_sma"]);
$matkul_favorit = ($_POST["matkul_favorit"]);
// variable gambar_sbl ini buat tanda kalo dia pake e gambar sng lama tidak upload gambar yang baru
$gambar_sbl = ($_POST["gambar"]);

// ini buat ngecek misal kita pengene ganti bio yg lain tp ga perlu ganti profil ada pengecekan ini dulu
// Misal ga ada file yg diunggah dia akan mengembalikan nilai '4' trs lak ws sama dengan '4' yg di $_FILES['gambar']['error'], maka akan dilakukan query untuk mengambil data gambar yang udah ada di database dengan SELECT gambar FROM mahasiswa WHERE nrp = '$nrp'.
// terus hasil query ini akan disimpan ke dalam variabel $row pake mysqli_fetch_assoc(). habis gitu, nilai gambar yang udah ada di database akan disimpan dalam variabel $gambar menggunakan $row['gambar'].
// tapi misal, nilai $_FILES['gambar']['error'] tidak sama dengan 4 atau dee mengupload gambar baru, maka akan memanggil fungsi upload() untuk mengunggah file gambar baru dan menyimpan nama file gambar baru dalam variabel $gambar. Variabel $gambar yang berisi nama file gambar baru iku nantie akan digunakan buat memperbarui gambar di database.


if ($_FILES['gambar']['error'] === 4) {
  // Jika tidak ada file yang diupload, gunakan gambar yang sudah ada
  $query = "SELECT gambar FROM mahasiswa WHERE nrp = '$nrp'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $gambar = $row['gambar'];
} else {
  // Jika ada file yang diupload, upload file yang baru
  $gambar = upload();
}


$query = "UPDATE mahasiswa SET
              nrp = '$nrp',
              nama = '$nama',
              jenis_kelamin = '$jenis_kelamin',
              jurusan = '$jurusan',
              email_student = '$email_student',
              alamat = '$alamat',
              no_hp = '$no_hp',
              asal_sma = '$asal_sma',
              matkul_favorit = '$matkul_favorit',
              gambar = '$gambar'
            WHERE nrp = $nrp";
mysqli_query($conn, $query);

//mengalihkan halaman kembali ke index.php
header("location:index.php");
exit();

// ini juga sama, sebenere bisa kita include path tambah_aksi biar function upload nya jalan tp lebih efektif gini biar pasti aja
function upload()
{
  $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
  $namegambar = $_FILES['gambar']['name'];
  $x = explode('.', $namegambar);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['gambar']['size'];
  $file_tmp = $_FILES['gambar']['tmp_name'];

  // Cek apakah ekstensi file yang diupload diizinkan
  if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
    return false;
  }

  // Cek ukuran file
  if ($ukuran > 2000000) {
    return false;
  }

  // Pindahkan file ke direktori 'berkas'
  if (move_uploaded_file($file_tmp, 'berkas/' . $namegambar)) {
    return $namegambar;
  } else {
    return false;
  }


}

// =================================================================

// $nrp = ($_POST["nrp"]);
// $nama = ($_POST["nama"]);
// $jenis_kelamin = ($_POST["jenis_kelamin"]);
// $jurusan = ($_POST["jurusan"]);
// $email_student = ($_POST["email_student"]);
// $alamat = ($_POST["alamat"]);
// $no_hp = ($_POST["no_hp"]);
// $asal_sma = ($_POST["asal_sma"]);
// $matkul_favorit = ($_POST["matkul_favorit"]);
// $gambar_sbl = ($_POST["gambar"]);

// // cek apakah user mau memilih foto profil yang baru atau tidak
// if ($_FILES['gambar']['error'] === 4) {
//   $gambar = $gambar_sbl;
// } else {
//   $gambar = upload();
// }

// $query = "UPDATE mahasiswa SET
//               nrp = '$nrp',
//               nama = '$nama',
//               jenis_kelamin = '$jenis_kelamin',
//               jurusan = '$jurusan',
//               email_student = '$email_student',
//               alamat = '$alamat',
//               no_hp = '$no_hp',
//               asal_sma = '$asal_sma',
//               matkul_favorit = '$matkul_favorit',
//               gambar = '$gambar'
//             WHERE nrp = $nrp";
// mysqli_query($conn, $query);

// //mengalihkan halaman kembali ke index.php
// header("location:index.php");
// return mysqli_affected_rows($conn);
