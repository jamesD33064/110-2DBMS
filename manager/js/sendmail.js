function change_customer(){
    var id = document.getElementById("customer_id").value;
    get("../db/sendmail.php?")
    .then((res) => {
    })
}

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