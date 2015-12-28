<?php include('head.php'); ?>
<?php include('login.php'); ?>
<?php if(isset($_SESSION['user_id']) and $_SESSION['user_id']>0) { ?>
<?php
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_active=1');
	$stmt->execute();
	$liste = $stmt->fetchAll();
?>
<table width="100%">
	<tr>
		<?php foreach($liste as $result) { ?>
		<td>
						<form method="post">
							<button class="afficher_deux_lignes btn btn-success" name="print_langue">Texte annuel<br><?php echo $result['langue_nom']; ?></button>
							<input type="hidden" name="langue_id" value="<?php echo $result['langue_id']; ?>" />
						</form>
						<br>
						<form method="post">
							<button class="afficher_deux_lignes btn btn-info cantique" name="print_cantique">Cantique<br><?php echo $result['langue_nom']; ?></button>
							<input type="hidden" name="langue_id" value="<?php echo $result['langue_id']; ?>" />
						</form>
		</td>
		<?php } ?>
	</tr>
</table>
<br />
<br />
<!-- NOUVEAU TEXTE -->
<form method="post" style="display:inline">
<button class="btn btn-warning afficher_une_ligne nouveau_texte" name="add">Créer un nouveau texte</button>
</form>
<!-- -->
<!-- NOUVEAU MEDIA -->
<form method="post" class="submit_data" style="display:inline" enctype="multipart/form-data" >
	<input data-filename-placement="inside" type="file" class="afficher_une_ligne btn-primary select_media" title="Choisir une image à afficher" name="picture_file" accept=".png,.jpg" />
	<input type="hidden" name="show_picture" />
</form>
<form method="post" class="submit_data" style="display:inline" enctype="multipart/form-data" >
	<input data-filename-placement="inside" type="file" class="afficher_une_ligne btn-primary select_media" title="Choisir une vidéo à afficher" name="video_file" accept=".mp4" />
	<input type="hidden" name="show_video" />
</form>
<!-- -->
</body>
</html>
<div align="center" class="dialog_cantique" style="display:none">
	<label>Numéro du cantique : </label>
	<input type="text" name="cantique" id="cantique" size="5" />
</div>
<div align="center" class="dialog_nouveau_texte" style="display:none">
	<label>Texte : </label>
	<textarea name="nouveau_texte" id="nouveau_texte"></textarea>
	<label>Afficher la date et l'heure : </label>
	<input type="checkbox" id="date_time" name="date_time" />
</div>
<?php } ?>
