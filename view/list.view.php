<?php require_once '../include.php';
$db = new DB();
$videos = $db->select(); ?>
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
    <div class="container">
        <h4> Yüklenilen Videolar </h4>
        <div class="videoList">
            <?php foreach ($videos as $key => $value) : ?>

                <div style="height:10px;"></div>
                <div class="card">
                    <div class="card-header"> <b> Video Başlık: <?= $value->VideoTitle ?> </b></div>
                    <div class="card-body">
                        <iframe width="300" height="200" src="https://www.youtube.com/embed/<?= $value->VideoLink ?>">
                        </iframe>
                    </div>
                    <div class="card-footer">
                        Boyut : <?= $value->VideoSize ?> bayt
                        <br>
                        Süre: <?= $value->VideoLength ?> sn
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>

</body>

</html>