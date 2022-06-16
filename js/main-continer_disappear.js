var a=0;

document.getElementById("hamburger").addEventListener('click', function(){
  
  if(a==0){
    document.getElementById("main-continer").style.display = "none";
    // alert("none");
    a=1;
  }
  else{
    document.getElementById("main-continer").style.display = "block";
    a=0;
    // alert("block");
  }
  
});