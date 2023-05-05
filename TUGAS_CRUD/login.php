<?php 
session_start();
include 'koneksi.php';

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//mengambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM admin WHERE id='$id'");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if(isset($_SESSION["login"])) {
	header("Location: index.php");
    exit;
}

if(isset($_POST['login'])) {
	global $conn;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");

	//cek username
	if(mysqli_num_rows($result) === 1) {
		//cek password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"]) ) {
			//set session
			$_SESSION["login"] = true;
			//cek remember me
			if(isset($_POST['remember'])) {
				//buat cookie
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time()+60);
			}

			header("Location: index.php");
			exit;
		}
	} 
	echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
	$error = true;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Membuat Login Dengan PHP dan MySQL</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<style>
		.card-login {
			margin: auto;
			margin-top: 50px;
			max-width: 400px;
			border: 1px solid #ccc;
			border-radius: 10px;
			padding: 20px;
			box-shadow: 0px 0px 10px #ccc;
		}
		.card-header {
			text-align: center;
			font-weight: bold;
			font-size: 24px;
			margin-bottom: 20px;
		}
		.input-group {
			margin-bottom: 20px;
		}
		.input-group label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}
		.btn {
			border-radius: 5px;
			font-weight: bold;
		}
		.login-register-text {
			margin-top: 20px;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<br><br><br><br><br>
				<div class="card-login">
					<div class="card-header mt-2">Sign In</div>
					<hr>
					<br>
					<?php if( isset($error) ) : ?>
						<p style="color: red; font-style: italic;">Username atau password Anda salah</p>
					<?php endif; ?>
					<div class="card-body">
						<form class="form-login" method="POST" action="">

							<div class="input-group mb-4">
								<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
								<input id="login-username" type="text" class="form-control" name="username" placeholder="Masukkan username">
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
								<input id="login-password" type="password" class="form-control" name="password" placeholder="Masukkan password">
							</div>
							<div class="form-group">
								<div class="form-check">
									<input type="checkbox" name="remember" id="remember" class="form-check-input">
									<label for="remember" class="form-check-label">Ingat saya</label>
								</div>
							</div>
							<div class="input-group">
								<button style="width : 100%;" type="submit" name="login" class="btn btn-primary btn-block">Login</button>
							</div>
							<hr>
							<p class="login-register-text">Belum punya akun?<span> <a href="register.php">Daftar disini</a></span></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/10512a1c83.js" crossorigin="anonymous"></script>

</body>
</html>