function get(url) {

    return new Promise((resolve, reject)=> {
        var req = new XMLHttpRequest();
        req.open('GET', url);
        req.onload = function() {
            if (req.status == 200 && req.readyState==4) {
                resolve(req.response);
            }
        };
        req.send();
    });
}

function createqrcode(id) {
    var input_text = "https://mspredator.com/110-2DBMS/110-2DBMS/php/qrcode.php?place_id="+id;
    var width = 150;
    var rectangle = width + "x" + width;
    var url = "https://chart.googleapis.com/chart?chs=" + rectangle + "&cht=qr&chl=" + input_text + "&choe=UTF-8&chld=M|2";
    // var qr_code = "<img alt='Your QRcode' src='" + url + "' />";
    return url;
}

get("../php/getid.php")
.then((res) => {
    // alert(createqrcode(res));
    // var obj = document.getElementById("qrcode");
    // obj.setAttribute("src","http://ithelp.ithome.com.tw/upload/images/20141015/20141015095459543dd3f36c448_resize_600.jpg");
    document.getElementById("qrcode_img").src = createqrcode(res);
})

// createqrcode();

