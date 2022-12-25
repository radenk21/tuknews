<?php 
    // melakukan koneksi ke database
    $conn = mysqli_connect('localhost','root','','tuknews');
    
    if($conn -> connect_error){
        die("Koneksi Gagal: " .$conn -> connect_error);
    }

    function query($query)
    {
        global $conn;
        $result = mysqli_query($conn,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row; 
        }
        return $rows;
    }

    function registrasi($data)
    {
        global $conn;
        $username = htmlspecialchars(stripslashes($data["username"]));
        $fullname = htmlspecialchars(stripslashes($data["fullname"]));
        $email = htmlspecialchars(stripslashes($data["email"]));
        $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
        $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data["password2"]));
    
        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        
        if(mysqli_fetch_assoc($result))
        {
            echo "<script>
                    alert('Username has registered');
                </script>";
            return false; 
        }
        // membuat username tidak boleh memiliki spasi
        if(preg_match_all('/\s/', $username)) {
            echo "<script>
                alert('Username cannot be spaces in it.');
            </script>";
            return false;
        }
        
        // cek email sudah ada atau belum
        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
        
        if(mysqli_fetch_assoc($result))
        {
            echo "<script>
                alert('Email has registered.');
            </script>";
            return false;            
        }
        // cek konfirmasi password
        if ($password !== $password2)
        {
            echo "<script>
                alert('Password doesn't match!');
            </script>";
            return false; 
        }
    
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        // add user ke database
        mysqli_query($conn, "INSERT INTO user (id, username, fullname, email, password) VALUES ('', '$username','$fullname','$email','$password')");
        
        return mysqli_affected_rows($conn);
    }

    function posting($data)
    {
        global $conn;
        $judul = htmlspecialchars($data['judul']);
        $kategori= $data['kategori'];
        $isiberita = $data['isiberita'];
        $poster = $_SESSION['username'];
        
        $gambarberita = upload();

        if(!$gambarberita)
        {
            return false;
        }

        $query = "INSERT INTO beritapost (poster, judul, gambarberita, konten, kategori)
                    VALUES ('$poster','$judul', '$gambarberita', '$isiberita','$kategori')
                ";
        mysqli_query($conn, $query);


        // var_dump($conn);

        mysqli_query($conn, "INSERT INTO beritapost (poster, judul, gambarberita, konten, kategori) VALUES ('$poster','$judul', '$gambarberita', '$isiberita','$kategori')");
        
        return mysqli_affected_rows($conn);
    }

    function upload()
    {
        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // cek apakah tidak ada gambar yang di upload
        if ($error === 4) {
            echo "
                <script>
                    alert('pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        // cek yang di upload adalah gambar

        $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensigambar = pathinfo($namafile, PATHINFO_EXTENSION);
        // $ekstensigambar = explode('.', $namafile);
        // $ekstensigambar = strtolower(end($ekstensigambar));

        if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
            echo "
                <script>
                    alert('Berikan file berformat jpg / jpeg / png / jfif);
                </script>";
            return false;
        }

        // cek jika ukurannnya terlalu besar
        if ($ukuranfile > 1000000) {
            echo "
                <script>
                    alert('ukuran gambar terlalu besar!');
                </script>";
            return false;
        }

        // lolos pengecekan, gambar siap upload
        // generate nama gambar baru
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensigambar ;

        move_uploaded_file($tmpName, 'img/'. $namafilebaru);

        return $namafilebaru;
    }

    function komentar($data,$lokasi,$pp)
    {
        global $conn;
        $idkomen = $_SESSION['id'];
        $namakomen = $_SESSION['username'];
        $isikomentar = $data['isikomentar'];
        $berita = $lokasi;

        // mendapatkan judul berita
        $queryberita = "SELECT judul FROM beritapost WHERE id=$lokasi";
        $judulberita = query($queryberita)[0]['judul'];        

        $query = "INSERT INTO komentar (idkomen, namakomen, isikomentar, status, berita, judulberita, ppgambar)
                    VALUES ('$idkomen', '$namakomen', '$isikomentar', '', '$berita','$judulberita','$pp')
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapus($id)
    {
        global $conn;
        // menghapus file yang ada di local
        $result = mysqli_query($conn, "SELECT gambarberita FROM beritapost WHERE id= $id ");   

        $file = mysqli_fetch_assoc($result);

        // fungsi implode untuk memisahkan string
        $filename = implode(".", $file);
        var_dump($filename);
        $location = "img/$filename";

        // mengecek apakah file ada di lokasi yang di masukkan
        if(file_exists($location))
        {
            // menghapus file
            unlink('img/'.$filename);
        }

        mysqli_query($conn, "DELETE FROM beritapost WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function hapuskomen($id)
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM komentar WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function ubahstatuskomen($id, $status)
    {
        global $conn;
        if($status == 0)
        {
            $query = "UPDATE komentar SET status = '1' WHERE id = $id"; 
        }
        else
        {
            $query = "UPDATE komentar SET status = '0' WHERE id = $id"; 
        }
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapusakun($id)
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM user WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function countberita($berita,$id)
    {
        global $conn;
        $i = $berita['kunjungan'];
        $i++;
        mysqli_query($conn,"UPDATE beritapost SET kunjungan = '$i' WHERE id = $id ");
    }

    function ubahleveluser($id, $leveluser)
    {
        global $conn;
        if($leveluser == 0)
        {
            $query = "UPDATE user SET leveluser = '1' WHERE id = $id"; 
        }
        else
        {
            $query = "UPDATE user SET leveluser = '0' WHERE id = $id"; 
        }
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function ubahprofil($data)    
    {
        global $conn;
        $id = $data["id"];
        $username = $data["username"];
        $fullname = htmlspecialchars($data["fullname"]);
        $email = htmlspecialchars($data["email"]);
        
        $gambarlama = htmlspecialchars($data["gambarlama"]);
            // cek apakah user memilih gambar baru atau tidak
        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        }
        else {
            $gambar = upload();
        }
        
        $query = "UPDATE user SET
                    nim = '$nim',
                    nama = '$nama',
                    email = '$email',
                    jurusan = '$jurusan',
                    gambar = '$gambar'
                WHERE id = $id
                    ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);   
    }
?>