<?php include('inc/fonctions.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head>
<title>Digital Signage for Kingdom Hall</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script src="js/tinymce_4.3.2/tinymce.min.js"></script>
<link rel="stylesheet" href="js/jquery-ui-1.11.4/jquery-ui.theme.css">
  <link rel="stylesheet" href="js/bootstrap-3.3.6-dist/css/bootstrap.css">
<script src="js/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
<script src="js/bootstrap.file-input.js"></script>
<link rel="stylesheet" href="css/ds4kh.css">
<?php include('js/script_afficheur.php'); ?>
</head>
<body onLoad="serverAutoRun()">
		<div id="text" class="text imgLiquidFill imgLiquid full" align="center" >
		</div>
	<div id="datetime" class="footer" style="color:#FFFFFF;font-size:24px;">
	<span>Nous somme le </span>
	<span id="dateNow"></span>
	<span>. Il est </span>
	<span id="timeNow"></span>
</div>
</body>
</html>

