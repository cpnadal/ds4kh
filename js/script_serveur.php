<script>
$( document ).ready(function() {

	tinymce.init({
		background: "black",
		plugins: "image",
		image_advtab: true,
		selector:'textarea',
		menubar: false,
		plugins: "textcolor",
		toolbar: "bold italic underline | fontsizeselect | fontselect | forecolor | alignleft aligncenter alignright alignjustify",
		fontsize_formats: "36pt 48pt 60pt 72pt 84pt 96pt 108pt 120pt 132pt",
		height : 500,
		width : "100%",
		entity_encoding: 'raw'	});

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
	$('.langue_new').click(function(){
		$('.langue_detail').show();
		$('#langue_nom').val();
		tinyMCE.get('langue_texte_annuel').setContent();
		$('#langue_cantique').val();
		$('#langue_id').val();
	});
	//
	
	// NOUVEAU MEDIA
	$('input[type=file]').bootstrapFileInput();
	$('.select_media').change(function() {
		var currentForm = $(this).closest('form');
		currentForm.submit();
	});
	//

	// CANTIQUE
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
		width:350,
		modal: false,
		autoOpen: false,
		buttons: {
			'Afficher ce numéro': function() {
				$(this).dialog('close');
				var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "cantique").val($('#cantique').val());
				currentForm.append($(input));
				currentForm.submit();
			},
			'Annuler': function() {
				$(this).dialog('close');
			}
		},
		open: function() {
			$(".dialog_cantique").keypress(function(e) {
				if (e.keyCode == $.ui.keyCode.ENTER) {
					$(this).parent().find('.ui-dialog-buttonpane button:first').trigger("click");
				}
			});
		}
	});
	//

	// TEXTE
	$('.nouveau_texte').click(function() {
		
          currentForm = $(this).closest('form');
          $(".dialog_nouveau_texte").dialog('open');
          return false;
		
	});
	$(".dialog_nouveau_texte").dialog({
		show: {
			effect: 'fade',
			duration: 500
		},
		hide: {
			effect: 'fade',
			duration: 500
		},
		title: 'Afficher un texte personnalisé',
		resizable: false,
		height:750,
		width:"100%",
		modal: false,
		autoOpen: false,
		buttons: {
			'Afficher ce texte': function() {
				var nouveau_texte = tinyMCE.get('nouveau_texte').getContent({format : 'raw'});
				$(this).dialog('close');
				var input = $("<textarea>")
				.attr("name", "texte").val(nouveau_texte);
				currentForm.append($(input));
				if( $('input[name=date_time]').is(':checked') ){
				var input = $("<input>")
				.attr("name", "datetime").val(1);
				currentForm.append($(input));
				}
				var input = $("<input>")
				.attr("name", "record_and_update").val("");
				currentForm.append($(input));
				currentForm.submit();
			},
			'Annuler': function() {
				$(this).dialog('close');
			}
		}
	});
	//

});
</script>