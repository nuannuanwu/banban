function preloadimages(arr, callback) {
    var newimages = [], newaudios = [], loadedimages = 0;
    var postaction = function () { alert("a"); }
    var arr = (typeof arr != "object") ? [arr] : arr;
    function imageloadpost() {
        loadedimages++;
        if (loadedimages == arr.length) {
            postaction();
        }
    }

    for (var i = 0; i < arr.length; i++) {
        if (/(png|gif|jpg)$/.test(arr[i])) {
            newimages[i] = new Image();
            newimages[i].src = arr[i];
            newimages[i].onload = function () {
                callback();
                imageloadpost()
            }
            newimages[i].onerror = function () {
                callback();
                imageloadpost()
            }
        }
        else if (/(mp3|wav)$/.test(arr[i])) {
            newaudios[i] = new Audio()
            newaudios[i].src = arr[i]
            callback();
            imageloadpost()
        }
    }
    return {
        done: function (f) {
            postaction = f || postaction
        }
    }
}