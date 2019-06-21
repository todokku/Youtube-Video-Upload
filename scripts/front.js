function _(id) {
    return document.getElementById(id);
}

const filter = _('filter'), filterControl = _('filterControl'), filterLengthControl = _('filterLengthControl'), filterSizeControl = _('filterSizeControl');

let isFilterActive;
let isCompressActive;
let videoMaxSize, videoMaxLength;

init();

filterControl.onchange = function (e) {
    isFilterActive = e.target.checked;

    if (isFilterActive) {
        filterActive();
        return;
    }
    filterPassive();
}

filterLengthControl.onchange = function (e) {
    videoMaxLength = e.target.value;
    _('printLength').innerHTML = " " + videoMaxLength + " DK";
}

filterSizeControl.onchange = function (e) {
    videoMaxSize = e.target.value;
    _('printSize').innerHTML = " " + videoMaxSize + " MB";
}

function init() {
    isFilterActive = true;
    isCompressActive = true;
    filterControl.checked = true;
    compressControl.checked = true;

    videoMaxSize = 4096;
    videoMaxLength = 5;

    filterLengthControl.value = videoMaxLength;
    filterSizeControl.value = videoMaxSize;

    _('printLength').innerHTML = " " + videoMaxLength + " DK";
    _('printSize').innerHTML = " " + videoMaxSize + " MB";

}
