<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload dan Download File</title>
    <style>
        body {
            width: 800px;
            margin: auto;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
            background-color: #060a1f;
            width: 100%; 
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            text-underline-position: under;
            text-decoration: underline black;
        }

        button{
            padding: 10px;
            font-weight: bold;
            color: white;
            background-color: #4caf50;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table thead{
            background-color: gray;
            border: 1px solid black;
            font-size: 16px;
            height: 50px;
            color: white;
        }

        table td{
            text-align: center;
            padding: 10px;
        }

        label{
            font-weight: bold;
            color: white;
            background-color: red;
            padding: 5px 10px;
            border-radius: 5px;
        }

        a{
            text-decoration: none;
            font-weight: bold;
            color: white;
            background-color: #4caf50;
            padding: 5px 10px;

        }

        a:hover{
            color: black;
        }

        div{
            border: 1px solid black;
            width: 100%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        
    </style>
</head>
<body>
    <div>
    <h2>Tabel Hasil Upload dan Download</h2>
    <?php
    include 'koneksi.php';  

    if(isset($_POST['submit'])){
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
        $namegambar = $_FILES['gambar']['name'];
        $x = explode('.', $namegambar);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['gambar']['size'];
        $file_tmp = $_FILES['gambar']['tmp_name'];	
    
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 2000000){			
                move_uploaded_file($file_tmp, 'berkas/'.$namegambar);
                $query = mysqli_query($conn,"insert into unggah values('','$namegambar')");
                if($query){
                    echo 'gambar berhasil diupload';
                }else{
                    echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            }else{
                echo 'UKURAN FILE TERLALU BESAR';
            }
        }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }
    ?>

    <button onclick="document.location='upload.php'">Tambahkan File</button>
    <table border="1">
        <thead>
            <tr>
                <th style="width: 30px">No</th>
                <th>Nama File</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM unggah";
			$data = mysqli_query($conn, $sql);
			while($d = mysqli_fetch_array($data)){
                $nomer = $nomer = 1;
			?>
			<tr>
                <td><?= $nomer++ ?></td>
				<td>
					<img src="<?php echo "berkas/".$d['gambar']; ?>">
				</td>		
			</tr>
			<?php } ?>
	
                    
        </tbody>
    </table>
    </div>
</body>
</html>