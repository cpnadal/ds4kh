<?php include('inc/fonctions.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/ds4kh.css">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script src="js/tinymce_4.3.2/tinymce.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/bootstrap.file-input.js"></script>
<?php include('js/script_serveur.php'); ?>
<script>
$( document ).ready(function() {
$('input[type=file]').bootstrapFileInput();

	$('.select_media').change(function() {
		$(this).closest('form').submit();
	});
var currentForm;	
	$('.cantique').click(function() {
		
          currentForm = $(this).closest('form');
          $(".dialog_cantique").dialog('open');
          return false;
		
	});
        $(".dialog_cantique").dialog({
					show: {
						effect: 'fade',
						duration: 500
					},
					hide: {
						effect: 'fade',
						duration: 500
					},
					title: 'Afficher le numéro du cantique',
					dialogClass: 'no-close',
					resizable: false,
					height:'auto',
					width:'auto',
					modal: false,
            autoOpen: false,
            buttons: {
                'Afficher': function() {
                    $(this).dialog('close');
					var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "supprimer_anecdote").val("");
					currentForm.append($(input));
                    currentForm.submit();
                },
                'Annuler': function() {
                    $(this).dialog('close');
                }
            }
        });
        $(".supprimer_anecdote").click(function() {
          currentForm = $(this).closest('form');
          $("#dialog_supprimer").dialog('open');
          return false;
        });

});

</script>
</head>
<body style="background-color:#FFEEEE;padding-left:10px;padding-right:10px">
<h1 align="center">GESTION DE L'ECRAN D'AFFICHAGE DU TEXTE DE L'ANNEE</h1>
<br>
<h2 align="center">SALLE PRINCIPALE</h2>
<br>
<?php if(!isset($_SESSION['user_id'])) { ?>
<div align="center">
<form method="post">
<table>
	<tr>
		<td>Nom d'utilisateur : </td>
		<td><input type="text" name="login_username" /></td>
	</tr>
	<tr>
		<td><br></td>
	</tr>
	<tr>
		<td>Mot de passe : </td>
		<td><input type="password" name="login_password" /></td>
	</tr>
	<tr>
		<td><br></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" class="btn btn-success" name="login_submit" value="Je me connecte" /></td>
	</tr>
</table>
</form>
</div>
<?php } else { ?>
<?php
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_active=1');
	$stmt->execute();
	$liste = $stmt->fetchAll();
?>
<table>
	<tr>
		<?php foreach($liste as $result) { ?>
		<td>
						<form method="post">
							<button class="afficher btn btn-success" name="print_langue">Texte annuel<br><?php echo $result['langue_nom']; ?></button>
							<input type="hidden" name="langue_id" value="<?php echo $result['langue_id']; ?>" />
						</form>
						<br>
						<form method="post">
							<button class="afficher btn btn-info cantique" name="print_cantique">Cantique<br><?php echo $result['langue_nom']; ?></button>
							<input type="hidden" name="langue_id" value="<?php echo $result['langue_id']; ?>" />
						</form>
		</td>
		<?php } ?>
	</tr>
</table>
<br />
<br />
<form method="post" class="submit_data" style="display:inline" id="upload_image" enctype="multipart/form-data" >
<input data-filename-placement="inside" type="file" class="afficher btn-primary select_media" title="Choisir une image à afficher" id="picture_file" name="picture_file" accept=".png,.jpg" /></td>
</form>
<form method="post" class="submit_data" style="display:inline" id="upload_video" enctype="multipart/form-data" >
<input data-filename-placement="inside" type="file" class="afficher btn-primary select_media" title="Choisir une vidéo à afficher" id="video_file" name="video_file" accept=".mp4" /></td>
</form>
<button class="btn btn-warning layout_add afficher" name="add">Créer un nouveau texte</button></div>
<div>
<br />
<div class="layout_edit" style="display:none">
	<form method="post" id="submit">
		<table width="100%">
			<tr>
				<td width="7%">Nom : </td>
				<td><input type="text" name="name" id="name" size="50" /></td>
			</tr>
			<tr>
				<td><br></td>
			</tr>
			<tr>
				<td>Texte : </td>
				<td><textarea id="texte" name="texte"></textarea></td>
			</tr>
			<tr>
				<td><br></td>
			</tr>
			<tr>
				<td>Date/Heure? : </td>
				<td><input type="checkbox" name="datetime" id="datetime"></td>
			</tr>
			<tr>
				<td><br></td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<button class="btn btn-success" name="record_and_update">Afficher sur l'écran</button>
				</td>
			</tr>
			<input type="hidden" id="id" name="id" value="" />
			<input type="hidden" id="action" name="action" value="" />
		</table>
	</form>
</div>
</body>
</html>
<div class="dialog_cantique" style="display:none">
<input type="text" name="cantique" />
</div>
<?php } ?>
