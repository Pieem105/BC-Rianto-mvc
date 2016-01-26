function toonRSS(str,id,aantal) {
  if (str.length==0) { 
    document.getElementById(id).innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		alert("Tekst van " + id + " wordt aangepast.")
      document.getElementById(id).innerHTML=xmlhttp.responseText;
    }
  }
alert("toonRSS: " + str + " & " + aantal);
  xmlhttp.open("GET","verkrijgRss.php?bron="+str+"&aantal="+aantal,true);
  xmlhttp.send();
}

function verversID(iId,sInhoud) {

document.alert(iId);
document.alert(sInhoud);  

if (sInhoud.length==0) { 
    document.getElementById("iId").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById(iId).innerHTML=sInhoud;
    }
  }
//  xmlhttp.open("GET","php/verkrijgRss.php?bron="+str+"&aantal="+aantal,true);
//  xmlhttp.send();
}
