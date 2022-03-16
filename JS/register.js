function test(){

var num_1 = document.getElementById("form3Example4cg").value;
var num_2 = document.getElementById("form3Example4cdg").value;
var check = document.getElementById("form2Example3cg").value;
if(num_1 != num_2){
    alert("密碼輸入錯誤");
    return false;
}
else if(!check.checked){
    alert("確認同意條款");
    return false;
}
return true;


}