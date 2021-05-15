function chontap(url){
    alert(url);
    document.getElementById("video").src = url;
}

function showResult(str) {
    if (str.length<3) {
      document.getElementById("livesearch").innerHTML="";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
      }
    };
    xmlhttp.open("GET","livesearch.php?s="+str,true);
    xmlhttp.send();
}



