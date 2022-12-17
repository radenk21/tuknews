<?php 
require "layout/header.php";
require "layout/navbar.php";
?>

<?php 
$berita = query("SELECT * FROM beritapost");
?>

<div class="carousel-news my-2">
        <div class="container">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <!-- indicator carousel start -->
                <div class="carousel-indicators">
                    <?php $i = 0; ?>
                    <?php foreach($berita as $car) : ?>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $i?>" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <?php $i++?>
                    <?php endforeach;?>
                </div>
                <!-- indicator carousel end -->
                <!-- isi carousel start -->
                <div class="carousel-inner">
                    <!-- hot news 1 -->
                    <?php foreach($berita as $car) : ?>
                        <?php $i = 0; ?>
                        <?php if($i == 0) : ?>
                        <div class="carousel-item active" data-bs-interval="3300">
                            <?php endif;?>
                            <?php if($i > 0) : ?>
                                <div class="carousel-item" data-bs-interval="3300">
                            <?php endif;?>

                            <a href="isiberita.php?id=<?= $car["id"] ?>">
                                <div class="car-img">
                                    <img height="400px" style="object-fit: cover;" src="img/<?= $car["gambarberita"]; ?>" class="d-block w-100" alt="">
                                </div>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?= $car["judul"]; ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php $i++;?>
                    <?php endforeach;?>
                </div>
                <!-- isi carousel end -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
</div>

<div class="listberita container-xxl">
    <div class="row">
        <div class="col">
            <div class="container">
                <h3 class="bg-secondary text-center text-white">Latest Post</h3>
                <?php 
                    $latest = query("SELECT * FROM beritapost ORDER BY id DESC");
                ?>
                <?php foreach($latest as $list) : ?>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/<?= $list['gambarberita']; ?>" class="img-fluid rounded-start" alt="<?= $list['judul'] ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="text-decoration-none" href="isiberita.php?id=<?= $list["id"] ?>">
                                        <h5 class="card-title"><?= $list["judul"] ?></h5>
                                        <div class="isikontenberita" style="height: 15vh; overflow:hidden;">
                                            <p class="card-text"><?= $list["konten"]; ?></p>
                                        </div>
                                    </a>
                                    <p class="card-text"><small class="text-muted">Posted on <?= $list["tanggalpost"]; ?> &nbsp <?= $list["timeposting"]?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="col">
            <div class="container">
                <h3 class="text-center bg-primary text-white">Popular</h3>
            </div>
        </div>
    </div>
</div>

<?php require "layout/footer.php";?>