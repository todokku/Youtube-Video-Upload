<?php
if (!isset($_SESSION['access_token'])) {
    header('Location: /index.php');
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video Yükleme Arayüzü</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-inverse">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/view/upload.view.php">Yeni Video Yükle </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/view/list.view.php"> Yüklenenleri Listele </a>
                </li>
            </ul>
        </div>
        <div class="form-inline my-2 my-lg-0">
            <a class="btn btn-outline-danger my-2 my-sm-0" href="/logout.php">Çıkış Yap</a>
        </div>
    </nav>
    <div style="height:15px;"></div>
    <div class="container">

        <div hidden id="spinner">
            <p> Video Yükleniyor <code> Lütfen Bekleyiniz </code> </p>
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div style="height:5px;"></div>

        <h2>Youtube Dosya Yükleme Formu </h2>
        <p>Bu arayüz vasıtasıyla yükleyeceğiniz dosyanın <code>başlığını</code> ve <code>kriterlerini</code> düzenleyebilirsiniz </p>

        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="videoTitle">Başlık:</label>
                <input type="text" class="form-control" placeholder="Video Başlığını Giriniz" id="videoTitle">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Yüklenecek video'yu seçiniz</label>
                <input type="file" class="form-control-file border" id="videoInput" accept=".mp4 , .mpeg , .mgp , .mov , .avi , .swf , .wmv , .asf">
            </div>
            <div class="form-group">
                <label for="pwd">Süresi: <b id="printLength"> </b></label>
                <input type="range" min='1' max='60' class="form-control-range" id="filterLengthControl">
            </div>
            <div class="form-group">
                <label for="filterSizeControl">Dosya Boyutu:<b id="printSize"> </b></label>
                <input type="range" min='100' max='10240' class="form-control-range" id="filterSizeControl">

            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="filterControl"> Dosya Boyutu ve Süresi Kontrol Edilsin
                </label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="compressControl"> Dosya Boyutu Sıkıştırılsın
                </label>
            </div>

            <button type="button" class="btn btn-primary" id="post">Kaydet</button>
        </form>

    </div>

    <div id="zaman"></div>
</body>
<script src="../scripts/front.js"></script>
<script>
    uploadLink = '../save.php';
    parameters = {}
</script>
<script src="../scripts/upload.js"></script>

</html>