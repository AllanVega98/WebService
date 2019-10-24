//Inicio función que valida que la cédula se encuentre en el SICAP
function loadLog() {
  var cedula= document.getElementById('cedula').value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("registrar").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "control.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("cedula="+cedula+""); 
}//Fin de la función