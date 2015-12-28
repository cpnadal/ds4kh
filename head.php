<?php include('inc/fonctions.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script src="js/tinymce_4.3.2/tinymce.min.js"></script>
<link rel="stylesheet" href="js/jquery-ui-1.11.4/jquery-ui.theme.css">
  <link rel="stylesheet" href="js/bootstrap-3.3.6-dist/css/bootstrap.css">
<script src="js/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
<script src="js/bootstrap.file-input.js"></script>
<link rel="stylesheet" href="css/ds4kh.css">
<?php include('js/script_serveur.php'); ?>
</head>
<body style="background-color:#FFEEEE;padding-left:10px;padding-right:10px">
<h1 align="center">GESTION DE L'ECRAN D'AFFICHAGE DU TEXTE DE L'ANNEE</h1>
<form style="float:right" method="post">
	<button class="btn btn-warning" name="administration">Administration</button>
	<?php if(isset($_SESSION['user_id']) and $_SESSION['user_id']==1 and $_SERVER['SCRIPT_NAME']=="/admin.php") { ?>
		<button class="btn btn-warning" name="utilisation">Utilisation</button>
		<button class="btn btn-danger" name="logoff">Se déconnecter</button>
	<?php } ?>
</form>