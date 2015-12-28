<script>
var XML_filename = "data.xml";
function serverAutoRun() {
	setInterval(function(){showDateTime()},100); //run showDateTime function every second
	document.bgColor="black"; //set background to black
	Current_fileTime= getFiletime();
	setInterval(function(){fileIsModified()},100); //run fileIsModified function every 5 seconds
	loadSettings();	//load moving message & currencies
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
	if(variable0=="video") {
		x=xmlDoc.getElementsByTagName("VIDEO");
		variable1 = x[0].childNodes[0].nodeValue;
		document.getElementById("text").innerHTML = '<video width="100%" height="100%" autoplay ><source src="'+variable1+'" type="video/mp4"></video>';
	}
	if(variable0!="image" && variable0!="video") {
		document.getElementById("text").innerHTML = variable0;
	}
	x=xmlDoc.getElementsByTagName("DATETIME");
	show_datetime = x[0].childNodes[0].nodeValue;
	if(show_datetime==1) {
		document.getElementById("datetime").style.display = 'block';
		showDateTime();
	} else {
		document.getElementById("datetime").style.display = 'none';
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

function showDateTime() {
	dateTimeNow = new Date(); 

	weekday = new Array(7);
	weekday[0]=  "Dimanche";
	weekday[1] = "Lundi";
	weekday[2] = "Mardi";
	weekday[3] = "Mercredi";
	weekday[4] = "Jeudi";
	weekday[5] = "Vendredi";
	weekday[6] = "Samedi";
	weekdayNow = weekday[dateTimeNow.getDay()];
	
	dd = dateTimeNow.getDate(); 
	mm = dateTimeNow.getMonth()+1;//January is 0! 
	yyyy = dateTimeNow.getFullYear(); 
	if(dd<10){dd='0'+dd};
	if(mm<10){mm='0'+mm}; 
	dateNow= weekdayNow + " " + dd + "/" + mm + "/" + yyyy;
	document.getElementById("dateNow").innerHTML = dateNow; 
	
	hh = dateTimeNow.getHours();
	nn = dateTimeNow.getMinutes();
	ss = dateTimeNow.getSeconds();
	if(hh<10){hh='0'+hh};
	if(nn<10){nn='0'+nn}; 	
	if(ss<10){ss='0'+ss}; 	
	timeNow = hh + ":" + nn + ":" + ss;
	document.getElementById("timeNow").innerHTML = timeNow; 
}
</script>