function test(){

    var id = document.getElementById("form3Example1cg").value;
    var password_1 = document.getElementById("form3Example4cg").value;
    var password_2 = document.getElementById("form3Example4cdg").value;
    var agree = document.getElementById("form2Example3cg");
    if(id.charAt(0) <= 97 || id.charAt(0) >= 122 || id.length != 10){
        alert("身分證輸入錯誤");
        return false;
    }
    if(password_1 != password_2){
        alert("密碼輸入錯誤");
        return false;
    }
    if(!agree.checked){
        alert("確認同意條款");
        return false;
    }
    return true;

}