<script>
var XML_filename = "data.xml";
function serverAutoRun() {
	document.bgColor="black";
	Current_fileTime= getFiletime();
	setInterval(function(){fileIsModified()},5000);
	loadSettings();
}

function fileIsModified() {
	lastModified_filetime= getFiletime();
	if 	(lastModified_filetime != Current_fileTime) {
		location.reload();
	}	
}

function getFiletime() {
	xmlhttp= create_XMLHttpRequest();
	xmlhttp.open("GET","fileLastModified.php" ,false);
	xmlhttp.send();
	txt=xmlhttp.responseText; 
	return txt;
}

function loadXMLdoc() {
	xmlhttp= create_XMLHttpRequest();
	xmlhttp.open("GET",XML_filename ,false);
	xmlhttp.send();
	return xmlhttp.responseXML; 
}	

function loadSettings() {	
	xmlDoc=loadXMLdoc();
	x=xmlDoc.getElementsByTagName("TEXT");
	variable0 = x[0].childNodes[0].nodeValue;
	if(variable0=="image") {
		x=xmlDoc.getElementsByTagName("IMAGE");
		variable1 = x[0].childNodes[0].nodeValue;
		document.getElementById("text").innerHTML = '<img src="'+variable1+'"  />';
	}
	if(variable0!="image" && variable0!="video") {
		document.getElementById("text").innerHTML = variable0;
	}
	$(document).ready(function () {
		$(".imgLiquidFill").imgLiquid({fill:true});
	});

}

function create_XMLHttpRequest() {
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}
</script>