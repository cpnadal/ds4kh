<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Digital Signage</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include('inc/fonctions.php'); ?>
<?php include('js/script_afficheur.php'); ?>
<script src ="js/imgLiquid.js" type="text/javascript"></script>
<script type="text/javascript"></script>
<style type="text/css">
body, html {
	margin:0;
	padding:0;
	width:100%;
	height:100%;
}
.full{
	width:100%;
	height:100%;
	background-color: #000;
	display: block;
	position: absolute;
	top: 0;
	bottom: 0;
	color: #FFF;
	align: center;
}
.footer {
	position: absolute;
	bottom: 0;
}
</style>
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

