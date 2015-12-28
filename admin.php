<?php include('inc/fonctions.php'); ?>
<?php if(isset($_SESSION['user_id']) and $_SESSION['user_id']==1) { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/ds4kh.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/bootstrap.file-input.js"></script>
<?php include('js/script_serveur.php'); ?>
<script>
$( document ).ready(function() {
$('input[type=file]').bootstrapFileInput();

	$('.langue_new').click(function() {
		$('#langue_nom').val("");
		tinyMCE.get('langue_texte_annuel').setContent('');
		$('#langue_cantique').val("");
		$('#langue_id').val("");
		$('.langue_detail').show();
	});

});
</script>
</head>
<body style="background-color:#FFEEEE;padding-left:10px;padding-right:10px">
<h1 align="center">GESTION DE L'ECRAN D'AFFICHAGE DU TEXTE DE L'ANNEE</h1>
<br>
<h2 align="center">ADMINISTRATION</h2>
<br>
<h3>Langues</h3>
<br>
<!-- LANGUES -->
<span class="glyphicon glyphicon-new langue_new">Ajouter une langue</span>
<br>
<?php
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_active=1');
	$stmt->execute();
	$liste = $stmt->fetchAll();
?>
<?php foreach($liste as $result) { ?>
<span class="glyphicon glyphicon-pencil langue_edit" value="<?php echo $result['langue_id']; ?>">&nbsp;<?php echo $result['langue_nom']; ?></span>
<br>
<?php } ?>
<div class="langue_detail" style="display:none">
<form method="post">
<table>
	<tr>
		<td>Nom : </td>
		<td><input type="text" id="langue_nom" name="langue_nom" /></td>
	</tr>
	<tr>
		<td>Texte de l'année : </td>
		<td><textarea id="langue_texte_annuel" name="langue_texte_annuel"></textarea></td>
	<tr>
		<td>Traduction de "Cantique" : </td>
		<td><input type="text" id="langue_cantique" name="langue_cantique" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<button class="btn btn-success" name="langue_edit">Enregistrer</button>
			<button class="btn btn-danger" id="langue_delete" name="langue_delete">Supprimer</button>
		</td>
	</tr>
</table>
<input type="hidden" id="langue_id" name="langue_id" value="" />
</form>
</div>
<br>
<!-- -->
<!-- UTILISATEURS -->
<div class="parametre edit_user">
<h4 align="center">Utilisateurs</h4>
<?php
	$stmt = $dbh->prepare('SELECT * FROM user WHERE id>1');
	$stmt->execute();
	$liste = $stmt->fetchAll();
?>
<?php foreach($liste as $result) { ?>
<span class="glyphicon glyphicon-pencil user_edit" value="<?php echo $result['id']; ?>">&nbsp;<?php echo $result['username']; ?></span>
<br>
<?php } ?>
<form method="post">
<table>
	<tr>
		<td>Nom d'utilisateur : </td>
		<td><input type="text" id="username" name="username" /></td>
	</tr>
	<tr class="password_edit" style="display:none">
		<td colspan="2"><input type="checkbox" class="edit_password" />&nbsp;Changer le mot de passe</td>
	</tr>
	<tr class="password">
		<td>Mot de passe : </td>
		<td><input type="text" id="password" name="password" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<button class="btn btn-success" name="user_edit">Enregistrer</button>
			<button class="btn btn-danger" id="user_delete" style="display:none" name="user_delete">Supprimer</button>
		</td>
	</tr>
</table>
<input type="hidden" id="user_id" name="user_id" value="" />
</form>
</div>
<!-- -->
<?php } ?>