<body>
    <!-- navbar start -->
    <header id="navbar">
        <div class="namee">
            <a href="index.php">
                <h1 id="first-name">Tuk</h1>
                <h1 id="last-name">News</h1>
            </a>
        </div>
        <nav>
            <div class="menu">
                <!-- kalau user belum login -->
                <?php if(!isset($_SESSION["login"])) :?>
                    <div class="clear">
                        <h3>LOGIN</h3>
                    </div>
                    <a href="./auth/register.php"><ion-icon class="navimg" name="log-in"></ion-icon></a>
                <?php endif;?>
            </div>
            <!-- kalau user sudah login -->
            <?php if(isset($_SESSION["login"])) :?>
                <div class="btn-group">
                    <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                        <!-- mengecek apakah user memiliki user memiliki foto profil-->
                        <?php if($_SESSION['gambar'] == null) :?>
                            <img src="img/nopict.png" width="50px" alt="Profil Akun <?= $_SESSION['username'];?>">
                        <?php endif;?>
                        <?php if($_SESSION['gambar'] != null) : ?>
                            <img src="img/<?= $_SESSION['gambar']; ?>" width="50px" style="border-radius:50%;" alt="profil akun <?= $_SESSION['username'] ?>">
                        <?php endif;?>
                        <!-- end pengecekan -->
                        <!-- menampilkan nama dari user -->
                        <?= ucwords($_SESSION['fullname']); ?>
                        <!-- end menampilkan -->
                    </div>
                    <?php if($_SESSION['leveluser'] == 0) : ?>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="profile.php">Info Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="riwayatkomentar.php">Riwayat Komentar</a>
                            </li>
                        </ul>
                    <?php endif;?>
                    <?php if($_SESSION['leveluser'] == 1) : ?>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="profile.php">Info Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="admin-dashboard.php">Admin Dashboard</a>
                            </li>
                        </ul>
                    <?php endif;?>
                    
                </div>
                <button type="button" class="navimg btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <ion-icon class="navimg" name="log-out-outline"></ion-icon>
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;" >Apakah Anda yakin ingin keluar?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <a href="logout.php" type="button" class="btn btn-primary">Ya</a>
                        </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </nav>
    </header>
    <!-- navbar end -->
    <!-- content start -->
    <div class="container-navbar">
        <div class="container">
            <!-- topic nav start -->
            <div class="header">
                <nav>
                    <a href="kategori.php?kategori=1">MARKET</a>
                    <a href="kategori.php?kategori=2">TECHNOLOGY</a>
                    <a href="kategori.php?kategori=3">ENTERTAINMENT</a>
                    <a href="kategori.php?kategori=4">SPORT</a>
                    <a href="kategori.php?kategori=5">LIFESTYLE</a>
                    <a href="kategori.php?kategori=6">GAME</a>
                </nav>
            </div>
        </div>
    </div>
        <!-- topic nav end -->
    <!-- content end -->