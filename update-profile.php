<?php 
    include "profile/profile-header.php"; 
?>
<?php 
$id_user = $_SESSION['id'];
$data = "SELECT * FROM user WHERE id='$id_user'";
$result = query($data);

include("function.php");
// men-check apakah tombol sumbit sudah ditekan atau belum
if (isset($_POST["ubah"])){


    // cek apakah data berhasil diubah atau tidak
    if ( ubah_profile($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href='update-profile.php?id=$id_user';
            </script>
            ";
    } else {

        echo "
            <script>
                alert('Data Gagal Diubah!');
                document.location.href='update-profile.php?id=$id_user';
            </script>
            ";
    }
}

 ?>

<div class="main-content">

<center><?php if($_SESSION['leveluser'] == 1) : ?>
        <?php include "layout/admin-navbar.php"; ?>

        <div class="profile container mt-4">
            <h2>Selamat datang Admin!</h2>
    <?php endif;?>


    <?php if($_SESSION['leveluser'] == 0) : ?>
        <?php include "layout/navbar.php" ?>

        <div class="profile container mt-4">
            <h2>Selamat Datang, <?= ucwords($_SESSION['fullname']) ?></h2>
    <?php endif;
    
    
    ?></center>


<div class="container align-self-center">
    <div class="main-content">
        
       

        <form action="" method="POST" enctype="multipart/form-data" id="form-ubah">
            <input type="hidden" name="id" id="id" value="<?= $_SESSION['id']; ?>">
            <input type="hidden" name="gambarlama" value="<?= $_SESSION['gambar']; ?>">
            <?php foreach($result as $hasil) : ?>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Foto Profile</div>
                        <div class="card-body">
                            <div class="text-center">
                            <!-- Profile picture image-->
                                <?php if($hasil['gambar'] == '') : ?>
                                    <img class="rounded-circle mb-2" width="150px" src="img/nopict.png" alt="">
                                <?php endif;?>
                                <?php if($hasil['gambar'] != '') : ?>
                                    <img class="rounded-circle mb-2" width="150px" src="img/<?= $hasil['gambar'] ?>" alt="">
                                <?php endif;?>
                            </div>
                            <div class="input-group mt-4">
                                <div class="form-group">
                                    <label for="foto">Foto Profil Baru</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Edit Profil</div>
                        <div class="card-body">
                            <!-- Form Group (Email) -->
                            <div class="form-group">
                                <label class="small mb-1" for="email">Email (Email tidak dapat diubah)</label>
                                <input type="email" name="email" id="email" class="form-control" readonly value="<?= $hasil['email']; ?>">
                            </div>
                            <!-- Form Group (username)-->
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="uname">Username (Nama yang akan tampil di website forum)</label>
                                <input class="form-control" id="uname" type="text" placeholder="Enter your username" name="username" value="<?= $hasil['username']; ?>">
                                <div id="uname-validation"></div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="fullname">Nama Lengkap</label>
                                <input class="form-control" id="fullname" type="text" placeholder="Enter your username" name="fullname" value="<?= $hasil['fullname']; ?>">
                                <div id="name-validation"></div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="ubah" class="btn btn-success">Simpan Perubahan</button>
                                <a href="update-profile.php?" id=<?= $hasil["id"]; ?> class="btn btn-outline-success">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#uname').blur(function(){
            event.preventDefault();
            var uname = $(this).val();
            var id_user = $('#id_user').val();
            $.ajax({
                type    : 'POST',
                url     : 'functions.php?aksi=validasi-uname',
                data    : { uname : uname, id_user : id_user},
                success : function(data){
                    if(data == "less"){
                        setError("#uname", "Username must be at least 5 characters");
                    } else if (data == "too much"){
                        setError("#uname", "Username cannot be more than 20 characters")
                    } else if(data == "ok"){
                        setSucces("#uname");
                    } else {
                        setError("#uname", "username has been used");
                    }
                }
            });
        });

        $('#form-ubah').submit(function(){
            if($('#uname').val().length < 5){
                setError("#uname", "Username setidaknya memiliki 5 karakter");
                return false;
            } else {
                setSucces("#uname");
            }

            if($('#uname').val().length >= 20){
                setError("#uname", "Username tidak boleh lebih dari 20 karakter");
                return false;
            } else {
            setSucces("#uname");
            }


            // validasi nama
            if($('#name').val().length == 0){
                setError("#name", "Name tidak boleh kosong");
                return false;
            } else {
                setSucces("#name");
            }
        });


        $('#name').blur(function(){
            event.preventDefault();
            if($('#name').val().length == 0){
                setError("#name", "Name tidak boleh kosong");
            } else {
                setSucces("#name");
            }
        });


        function setError(id, message){
            $(id).removeClass('is-valid');
            $(id).addClass('is-invalid');
            $(id+'-validation').removeClass('valid-feedback');
            $(id+'-validation').addClass('invalid-feedback');
            $(id+'-validation').html(message);
          return false;
        } 

        function setSucces(id){
            $(id).removeClass('is-invalid');
            $(id).addClass('is-valid');
            $(id+'-validation').removeClass('invalid-feedback');
            $(id+'-validation').html("");
            return true;     
        }
    });
</script>

<?php 
include("layout/footer.php");
?>