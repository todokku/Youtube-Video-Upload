<?php

require_once "include.php";
require_once "classes/api.class.php";

if (!isset($_SESSION['access_token'])) {
    header('Location: /index.php');
}

$file = $_FILES['video']['tmp_name'];
$db = new DB();

$video = new Video();
$video->VideoTitle = post('title');
$video->VideoSize = post('size');
$video->VideoLength = post('length');

if (post('compress')) {
    $ffmpeg = FFMpeg\FFMpeg::create();
    $comp = $ffmpeg->open($file);

    $comp->save(new FFMpeg\Format\Video\X264('aac', 'libx264'), 'videos/tmp/output.mp4');
    $media_file = 'videos/tmp/output.mp4';
} else
    $media_file = $file;

$api = new YoutubeApi();
$api->auth();
$api->setService();

$response = $api->videosInsert(
    $media_file,
    array(
        'snippet.categoryId' => '22',
        'snippet.defaultLanguage' => '',
        'snippet.description' => '',
        'snippet.tags[]' => '',
        'snippet.title' => $video->VideoTitle,
        'status.embeddable' => '',
        'status.license' => '',
        'status.privacyStatus' => 'public',
        'status.publicStatsViewable' => ''
    ),
    'snippet,status',
    array()
);
var_dump($response);
echo $response->id;

$video->VideoLink = $response->id;
$db->create($video);
