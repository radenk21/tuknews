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
$kategori = $_GET['kategori'];
$berita = query("SELECT * FROM beritapost");
?>

<div class="listberita container-xxl mt-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <?php 
                    $kategorilist = query("SELECT * FROM beritapost WHERE kategori='$kategori'");
                ?>
                <?php if(($kategori == '1')) :?>
                    <h3 class="text-center py-1 rounded-3 bg-secondary text-white">MARKET</h3>
                <?php endif;?>
                <?php if(($kategori == '2')) :?>
                    <h3 class="text-center py-1 rounded-3 bg-secondary text-white">TECHNOLOGY</h3>
                <?php endif;?>
                <?php if(($kategori == '3')) :?>
                    <h3 class="text-center py-1 rounded-3 bg-secondary text-white">ENTERTAINMENT</h3>
                <?php endif;?>
                <?php if(($kategori == '4')) :?>
                    <h3 class="text-center py-1 rounded-3 bg-secondary text-white">SPORT</h3>
                <?php endif;?>
                <?php if(($kategori == '5')) :?>
                    <h3 class="text-center py-1 rounded-3 bg-secondary text-white">LIFESTYLE</h3>
                <?php endif;?>
                <?php if(($kategori == '6')) :?>
                    <h3 class="text-center py-1 rounded-3 bg-secondary text-white">GAME</h3>
                <?php endif;?>
                <?php foreach($kategorilist as $list) : ?>
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
                    $popular = query("SELECT * FROM beritapost ORDER BY kunjungan DESC");
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
                    $komentar = query("SELECT * FROM komentar WHERE status = 1  ORDER BY tanggalacc DESC");
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