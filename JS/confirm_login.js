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
get("../php/welcome.php")
.then((res) => {
    if(res != ""){//如果為登入狀態
        document.getElementById("navbar_username").innerText = res;
        document.getElementById("navbar_signin").style.display="none";
        document.getElementById("navbar_logout").style.display="block";
        
        get("../php/getid.php")
        .then((res) => {
            data = JSON.parse(res);
            if(data[0]=="C"){
                document.getElementById('qrcode').style.display="none"
            }
            else if(data[0]=="P"){
                document.getElementById('qrcode').style.display="block"
            }
        })
    }
    else{//如果為非登入
        document.getElementById("navbar_username").innerText = "";
        document.getElementById("navbar_signin").style.display="block";
        document.getElementById("navbar_logout").style.display="none";
        
    }



});
