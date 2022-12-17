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
            $error = true;
            return; 
        }
        // membuat username tidak boleh memiliki spasi
        if(preg_match_all('/\s/', $username)) {
            $error = true;
            return;
        }
        
        // cek email sudah ada atau belum
        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
        
        if(mysqli_fetch_assoc($result))
        {
            $error = true;
            return; 
        }
        // cek konfirmasi password
        if ($password !== $password2)
        {
            $error = true;
            return;
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
            return FALSE;
        }

        $query = "INSERT INTO beritapost (poster, judul, gambarberita, konten, kategori)
                    VALUES ('$poster','$judul', '$gambarberita', '$isiberita','$kategori')
                ";
        mysqli_query($conn, $query);

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

        $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
        $ekstensigambar = pathinfo($namafile, PATHINFO_EXTENSION);
        // $ekstensigambar = explode('.', $namafile);
        // $ekstensigambar = strtolower(end($ekstensigambar));

        if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
            echo "
                <script>
                    alert('Berikan file berformat jpg / jpeg / png);
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
?>