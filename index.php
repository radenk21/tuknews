<?php 
require "layout/header.php";
require "layout/navbar.php";
$_SESSION['guest'] = TRUE;
if(isset($_SESSION['login']))
{
    unset($_SESSION['guest']);
}
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
                    <?php $i = 0; ?>    
                    <?php if($i == 0) : ?>
                        <div class="carousel-item active" data-bs-interval="3300">
                            <?php endif;?>
                        <?php foreach($berita as $car) : ?>
                            <?php if($i > 0) : ?>
                                <div class="carousel-item" data-bs-interval="3300">
                            <?php endif;?>

                            <a href="isiberita.php?id=<?= $car["id"] ?>">
                                <div class="car-img">
                                    <img height="500px" style="object-fit: cover;" src="img/<?= $car["gambarberita"]; ?>" class="d-block w-100" alt="">
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
                <h3 class="bg-secondary text-center bg-gradient text-white rounded-3">Latest Post</h3>
                <?php 
                    $latest = query("SELECT * FROM beritapost ORDER BY id DESC LIMIT 4");
                ?>
                <?php foreach($latest as $list) : ?>
                    <div class="card mb-3" >
                        <div class="row g-0">
                            <div class="col align-self-center">
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
        <div class="col-sm-4">
            <div class="row">
                <div class="container">
                    <h3 class="text-center py-1 bg-gradient rounded-3 bg-primary text-white">Popular</h3>
                    <?php 
                    $popular = query("SELECT * FROM beritapost ORDER BY kunjungan DESC LIMIT 3");
                    $i = 1;
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <?php foreach($popular as $hot) :?>
                                <div class="row">
                                    <div class="col-2 text-center"><h5><?= $i.'.' ?></h5></div>
                                    <div class="col"><a class="text-decoration-none" href="isiberita.php?id=<?= $hot['id'] ?>"><?= $hot['judul'] ?></a></div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    
                    <h3 class="mt-3 py-1 bg-primary bg-gradient rounded-3 text-white text-center">Comments</h3>
                    <?php 
                    $komentar = query("SELECT * FROM komentar WHERE status = 1  ORDER BY tanggalacc DESC LIMIT 4");
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <?php foreach($komentar as $komen) : ?>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h6><?= $komen['namakomen'] ?></h6>
                                        <p><?= $komen['isikomentar'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "layout/footer.php";?>