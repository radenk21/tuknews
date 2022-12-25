<?php 
include "layout/admin-header.php";
include "layout/admin-navbar.php";
?>
<?php 
// mengambil id  dari url
$idprofil = $_GET['id'];
$profil = query("SELECT * FROM user WHERE id = $idprofil")[0];

// if(isset($_POST['ubahprofil']))
// {
//     if(ubahprofil)
// }

?>

<h1>Info Profil</h1>
<table>
    <tr></tr>
</table>
<div class="container text-center">
  <div class="row">
      <div class="col-sm-3">
        <?php if($profil['gambar'] == "") :?>
        <img width="300" src="img/nopict.png" alt="Info Profil <?= ucwords($profil['fullname']) ?>">
        <?php endif;?>
        <?php if($profil['gambar'] != "") :?>
        <img width="300" src="img/<?= $profil['gambar'] ?>" alt="Info Profil <?= ucwords($profil['fullname']) ?>">
        <?php endif;?>
    </div>
    <div class="col-sm-9">
        <form action="" method="post">
            <input value="<?= $profil['id'] ?>" type="hidden" name="id" id="id" >
            <input value="<?= $profil['gambar'] ?>" type="hidden" name="gambarlama">
            <div class="row">
                <div class="col-8 col-sm-6">
                    <label for="username">Username</label>
                    <input required value="<?= $profil['username'] ?>" type="text" name="username" id="usernama">    
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-sm-6">
                    <label for="fullname">Full Name</label>
                    <input required value="<?= $profil['fullname'] ?>" type="text" name="fullname" id="fullname">
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-sm-6">
                    <label for="email">Email</label>
                    <input required value="<?= $profil['email'] ?>" type="text" name="email" id="email">
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-sm-6">
                    <label for="gambar" class="input-group-text" >Gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar">
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-sm-6">
                    <button type="submit" class="btn btn-success" name="ubahprofil">Ubah Profil</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-8 col-sm-6">
                <label for="leveluser">User Level</label>
                <?php 
                if($profil['leveluser'] == '0') 
                {
                    echo "<p>User</p>";
                }
                else {
                    echo "<p>Admin</p>";
                }
                ?>
                <a class="btn btn-primary" href="ubahleveluser.php?id=<?= $profil['id'] ?>&&leveluser=<?= $profil['leveluser'] ?>">Ubah Level User</a>                
            </div>
        </div>
    </div>
  </div>
</div>
<?php 
include "layout/admin-footer.php";
?>