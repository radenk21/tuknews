<?php 
    include "profile/profile-header.php";
?>
    <?php if($_SESSION['leveluser'] == 1) : ?>
        <?php include "layout/admin-navbar.php"; ?>
    <div class="profile container">
        <h1>Selamat datang Admin!</h1>
    <?php endif;?>
    <?php if($_SESSION['leveluser'] == 0) : ?>
        <?php include "layout/navbar.php" ?>
    <div class="profile container">
        <h1>Halo <?= ucwords($_SESSION['fullname']) ?></h1>
    <?php endif;?>
    <?php if($_SESSION['gambar'] == null) :?>
        <img src="img/nopict.png" width="100px" alt="Profil Akun <?= $_SESSION['username'];?>">
    <?php endif;?>
    <?php if($_SESSION['gambar'] != null) : ?>
        <img src="img/<?= $_SESSION['gambar']; ?>" width="100px" alt="profil akun <?= $_SESSION['username'] ?>">
    <?php endif;?>
    <br>
    <h2>Profile Info</h2>
    <h4>Username : <?= $_SESSION["username"] ?> </h4>
    <h4>Full name : <?= $_SESSION["fullname"] ?> </h4>
    <h4>Email : <?= $_SESSION["email"] ?> </h4>

</div>

<?php require "layout/footer.php";?>