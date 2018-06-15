var tgt = document.getElementById("note").innerHTML;
function wentwrong(tgt) {
  var xmlhttp;
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("note").innerHTML = xmlhttp.responseText;
      }
  };
  xmlhttp.open("POST","processlogin.php?d="+tgt,true);
  xmlhttp.send();
}
