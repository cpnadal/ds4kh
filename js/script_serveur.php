<script>
$( document ).ready(function() {
	tinymce.init({
		plugins: "image",
		image_advtab: true,
		selector:'textarea',
		menubar: false,
		plugins: "textcolor",
		toolbar: "bold italic | fontsizeselect | fontselect | forecolor | alignleft aligncenter alignright alignjustify",
		fontsize_formats: "36pt 48pt 60pt 72pt 84pt 96pt 108pt",
		height : 500,
		entity_encoding: 'raw'
	});

	$('.layout_show').click(function(){
		$('.layout_edit').show();
		$('.edit_user').hide();
		if(id!="") {
			$('#action').val('edit');
			$('#id').val($(this).val());
			var data = $.ajax({
				type: 'POST',
				url: 'inc/fonctions.php', 
				data: "action=select&layout_id="+$(this).val(),
				dataType: "json",
				success: function(response) {
					if(response.datetime==1) {
						$('#datetime').attr('checked',true);
					} else {
							$('#datetime').removeAttr('checked');
					}
					$('#name').val(response.name);
					tinyMCE.get('texte').setContent(response.text);
				}
			})
			
		}
		return false;
	});

	$('.layout_hide').click(function(){
		$('.layout_edit').hide();
	});
	
	$('.layout_delete').click(function(){
		$('.delete_confirm').not($('.delete_confirm_'+$(this).attr('value'))).hide('slow');
		if($(this).text()=="Supprimer") {
			$('.layout_delete').text("Supprimer");
			$(this).text("Annuler");
		} else {
			$(this).text("Supprimer");
		}
		$('.delete_confirm_'+$(this).attr('value')).toggle('slow');
	});
	

	$('.layout_add').click(function(){
		$('.layout_edit').show();
		$('#action').val('add');
		$('#id').val('');
		$('#name').val('');
		tinyMCE.get('texte').setContent('');
		return false;
	});
	<?php if(isset($_POST['id']) and $_POST['id']!="") { ?>
		$('#action').val('edit');
		$('#id').val(<?php echo $_POST['id']; ?>);
		var data = $.ajax({
			type: 'POST',
			url: 'inc/fonctions.php', 
			data: "action=select&layout_id="+<?php echo $_POST['id']; ?>,
			dataType: "json",
			success: function(response) {
				if(response.datetime==1) {
					$('#datetime').attr('checked',true);
				} else {
					$('#datetime').removeAttr('checked');
				}
				$('#name').val(response.name);
				var update_texte = response.text;
				tinyMCE.get('texte').setContent(response.text);
			}
		})
	<?php } ?>

	$('#submit').submit(function(){
		var erreur = 0;
		var texte_erreur = "";
		var erreur_nom = 0;
		var erreur_texte = 0;
		if( !$('#name').val() ) {
 			erreur_nom = 1
			erreur = 1
		}
		if( tinyMCE.get('texte').getContent()=='' ) {
			erreur_texte = 1
			erreur = 1
		}
		if(erreur==1) {
			texte_erreur = "Les champs suivants ne peuvent pas être vides : \n\r";
			if(erreur_nom==1) { texte_erreur += "- Nom"; }
			if(erreur_texte==1) { texte_erreur += "\n- Texte"; }
			texte_erreur += "\n\rMerci de les remplir";
			alert(texte_erreur);
			return false;
		}

	});
	$('.user').click(function(){
		$('.layout_edit').hide();
		$('.edit_user').toggle();
		$('.edit_parameters').hide();
	});
	$('.langue').click(function(){
		$('.parametre').hide();
		$('.edit_langue').toggle();
	});
	$('.edit_password').click(function(){
		if($(this).is(':checked')){ 
			$('.password').show();
			$('#password').removeAttr('disabled');
		} else {
			$('.password').hide();
			$('#password').attr('disabled',true);
		}
	});
	$('.user_edit').click(function(){
		$('#user_delete').show();
		$('#user_id').val($(this).attr('value'));
		var data = $.ajax({
			type: 'POST',
			url: 'inc/fonctions.php', 
			data: "action=select_user&user_id="+$(this).attr('value'),
			dataType: "json",
			success: function(response) {
				$('#username').val(response.username);
			}
		})
		$('.password_edit').show();
		$('.password').hide();
		$('#password').attr('disabled',true);
	});
	
	// LANGUES
	$('.langue_edit').click(function(){
		$('.langue_detail').show();
		var data = $.ajax({
			type: 'POST',
			url: 'inc/fonctions.php', 
			data: "action=select_langue&langue_id="+$(this).attr('value'),
			dataType: "json",
			success: function(response) {
				$('#langue_nom').val(response.langue_nom);
				tinyMCE.get('langue_texte_annuel').setContent(response.langue_texte_annuel);
				$('#langue_cantique').val(response.langue_cantique);
				$('#langue_id').val(response.langue_id);
				
			}
		})
	});
	//
	
	$('.screen_edit').click(function(){
		$('#screen_delete').show();
		$('#screen_id').val($(this).attr('value'));
		var data = $.ajax({
			type: 'POST',
			url: 'inc/fonctions.php', 
			data: "action=select_screen&screen_id="+$(this).attr('value'),
			dataType: "json",
			success: function(response) {
				$('#screen_name').val(response.screen_name);
				$('#screen_width').val(response.screen_width);
				$('#screen_height').val(response.screen_height);
			}
		})
		$('.password_edit').show();
		$('.password').hide();
		$('#password').attr('disabled',true);
	});
	$('.mode').change(function() {
		alert('t');
	});

});
</script>