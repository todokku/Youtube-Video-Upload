let video = {};

const videoInput = _('videoInput');
videoInput.onchange = function (e) {
    video = e.target.files[0];
    if (!isFileAVideo(video)) {
        alert('lütfen bir video seçiniz..');
        this.value = '';
        return;
    }

    var fr = new FileReader();
    fr.onload = function (file) {
        var fileContent = file.target.result;

        var videoPre = document.createElement('video');
        videoPre.controls = true;

        var source = document.createElement('source');
        source.type = 'video/mp4';
        source.src = fileContent;

        videoPre.appendChild(source);

        videoPre.onloadedmetadata = function () {
            video.duration = this.duration;
        }
    }
    fr.readAsDataURL(video);
}

function isFileAVideo(video) {
    $ext = video['name'].split('.').pop();

    if ($ext != 'mp4' && $ext != 'mpeg'
        && $ext != 'mgp' && $ext != 'mov'
        && $ext != 'avi' && $ext != 'swf'
        && $ext != 'wmv' && $ext != 'asf') {
        return false;
    }
    return true;
}

function isVideoValiable() {
    if (video.size > (videoMaxSize * 1024) || video.duration > (videoMaxLength * 60))
        return false;
    return true;
}

const post = _('post');
post.onclick = function () {

    if (videoInput.files.length <= 0 || _('videoTitle').value.trim().length <= 0) {
        alert("lütfen gerekli alanları doldurunuz");
        return;
    }

    if (isFilterActive) {
        if (!isVideoValiable()) {
            alert("yüklenilen video kriterlere uygun değil");
            return;
        }
    }

    upload();
}

function upload() {

    var formData = new FormData();
    formData.append("size", video.size);
    formData.append("length", video.duration);
    formData.append("title", _('videoTitle').value);
    if (_('compressControl').checked) {
        formData.append("compress", true);
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", uploadLink, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            _('spinner').hidden = true;
            console.log(xhr.response);
            console.log("şimdi tamamlandı");
            window.location.href = "/view/list.view.php";
        }
    }

    xhr.onloadstart = function (e) {
        _('spinner').hidden = false;
    }

    formData.append("video", video);
    xhr.send(formData);

    console.log("video yükleniyor");
}

