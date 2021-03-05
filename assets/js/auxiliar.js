
function acumular() {    
    var valor = parseInt(document.getElementById("flagdata").value);
    valor = isNaN(valor) ? 0 : valor;
    document.getElementById("flagdata").value = valor +1;
}

// para el listado de informacion (informacion.php)
function showUser(str) {
  if (str == "") {
    document.getElementById("info").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("info").innerHTML = this.responseText;
        document.getElementById("info").style.display='block';
      }
    };
    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.send();
  }
}

// Para el formulario de Administrador (index.php)
function showGrupos() {
    var str = document.getElementById("seccion").value;
    var divcrr = document.getElementById("ctx");
    var vacio = '<div id="select2" name="select2" class="col6 col-12-xsmall"></div>';
    var crr = "";
    if (divcrr) {
        crr = divcrr.value;
        if (crr == undefined) {
            crr = "";
        }
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (str < '4') {
            document.getElementById("select1").innerHTML = this.responseText;
            document.getElementById("select2").innerHTML = vacio;
        } else {
            if (str == '4' && crr == "") {
                document.getElementById("select1").innerHTML = this.responseText;
            } else {
                document.getElementById("select2").innerHTML = this.responseText;
            }
        }
      }
    };
    
    var str1 = "datos.php?seccion=";
    var str2 = "&ctx=";
    var url = str1.concat(str, str2, crr);
    xmlhttp.open("GET",url,true);
    xmlhttp.send(); 
}


// para el aviso de bloqueo/desbloqueo de boleta (informacion.php)
 function unlock(str) {
  if (str == "") {
    document.getElementById("info").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("info").innerHTML = this.responseText;
        document.getElementById("info").style.display='block';
      }
    };
    xmlhttp.open("GET","unlock.php?id="+str,true);
    xmlhttp.send();
  }
}

function responsiveMenu() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}



// Desbloquear Avisos -> cambia el estatus en la BD
 function unlockaviso(id, tipo) {
    var idr = 'lock_'+id;
    //alert ("Cadena: "+idr);
    var ant = document.getElementById(idr).innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(idr).innerHTML = this.responseText;
      } else {
        document.getElementById(idr).innerHTML = ant;
      }
      location.reload();
    };
    var str1 = "unlockavisos.php?id=";
    var str2 = "&type=";
    var url = str1.concat(id, str2, tipo);
    //alert (url);
    xmlhttp.open("GET",url, true);
    xmlhttp.send();
  }



function responsiveMenu() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}



// para los avisos aviso.php
function showGrupos2() {
    var str = document.getElementById("seccion").value;
    var divcrr = document.getElementById("ctx");
    var crr = "";
    var divgrp = document.getElementById("Active");
    var grupo = "";    
    var vacio = '<div id="select2" name="select2" class="col6 col-12-xsmall"></div>';
    var vacio2 = '<div id="grados" name="grados" class="col-4 col-12-xsmall"><select id="grado" name="grado" tabindex="4" required><option value="" disabled selected>Elige el grado</option></select></div>';
    if (divcrr) {
        crr = divcrr.value;
        if (crr == undefined) {
            crr = "";
        }
    }
    if (divgrp) {
        grupo = divgrp.value;
        if (grupo == undefined) {
            grupo = "";
        }
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (str < '4') {
            document.getElementById("select1").innerHTML = this.responseText;
            document.getElementById("select2").innerHTML = vacio;
        } else {
            if (str == '4' && crr == "") {
                document.getElementById("select1").innerHTML = this.responseText;
            } else {
                document.getElementById("select2").innerHTML = this.responseText;
            }
        }
        if (grupo == "") {
            showGrados();
        } else {
            document.getElementById("grados").innerHTML = vacio2;
        }
      }
    };
    
    var str1 = "datos.php?seccion=";
    var str2 = "&ctx=";
    var str3 = "&origen=aviso";
    var url = str1.concat(str, str2, crr, str3);
    xmlhttp.open("GET",url,true);
    xmlhttp.send(); 
}

// 
function showGrados() {
    var str = document.getElementById("seccion").value;
    var g_0=new Array("1","2","3");
    var g_1=new Array("1","2","3","4","5","6");
    var g_2=new Array("1","2","3");
    var g_3=new Array("1","2","3","4","5","6");
    var g_4=new Array("1","2","3","4","5","6","7","8");

    var grados = [ g_0, g_1, g_2, g_3, g_4 ];
    
    var  str1 = document.Aviso.seccion[document.Aviso.seccion.selectedIndex].value;
   	misgrados=grados[str1];
    numgrados = misgrados.length;
    document.Aviso.grado.length = numgrados;
    for(i=0;i<numgrados;i++){ 
      	document.Aviso.grado.options[i].value=misgrados[i];
      	document.Aviso.grado.options[i].text=misgrados[i]; 
    }	
   	// Marco el primer grado seleccionado
   	//document.Aviso.grado.options[0].selected = true;
}


function hideGrados() {
    var vacio = '<div id="grados" name="grados" class="col-4 col-12-xsmall"></select></div>';
    document.getElementById("grados").innerHTML = vacio;
}
