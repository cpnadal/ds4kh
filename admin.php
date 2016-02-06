<?php include('head.php'); ?>
<?php include('login.php'); ?>
<?php if(isset($_SESSION['user_id']) and $_SESSION['user_id']==1) { ?>
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
<table width="100%">
	<tr>
		<td>Nom : </td>
		<td><input type="text" id="langue_nom" name="langue_nom" /></td>
	</tr>
	<tr>
		<td>Texte : </td>
		<td><textarea id="langue_texte_annuel" name="langue_texte_annuel"></textarea></td>
	<tr>
		<td>"Cantique" : </td>
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
<h3>Utilisateurs</h3>
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
<br>
<!-- -->
<!-- MISE A JOUR DU SYSTEME -->
<div class="parametre upgrade_database">
<h3>Mise à jour du système</h3>
<form method="post">
<button class="btn btn-danger" name="database_update">Je mets à jour la base de données</button>
<button class="btn btn-danger" name="system_update">Je mets à jour le système</button>
</form>
</div>
<!-- -->
<?php } ?>