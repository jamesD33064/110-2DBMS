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

var id=2;

get("../php/qrcode.php")
.then((res) => {
    id=Number(res);
})

createqrcode();

function createqrcode() {
    var input_text = "https://mspredator.com/110-2DBMS/110-2DBMS/php/qrcode.php?place_id="+id;
    var width = 57;
    var rectangle = width + "x" + width;
    var url = "https://chart.googleapis.com/chart?chs=" + rectangle + "&cht=qr&chl=" + input_text + "&choe=UTF-8&chld=M|2";
    var qr_code = "<img alt='Your QRcode' src='" + url + "' />";
    $('#qrcode').html(qr_code);
}
