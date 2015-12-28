<?php
// ARRET DU SYSTEME
if(isset($_POST['halt'])) {
	exec('sudo halt');
}

// REBOOT DU SYSTEME
if(isset($_POST['reboot'])) {
	exec('sudo reboot');
}

// LANCEMENT DE LA SESSION
session_start();

// CONNEXION A LA BASE DE DONNEES
$user = "root";
if($_SERVER['SERVER_NAME']=="ds4kh.dev") {
	$pass = "";
} else {
	$pass = "alctj";
}
$dbh = new PDO('mysql:host=localhost;dbname=signage', $user, $pass);
$dbh->exec("SET NAMES 'utf8'");
$dbh->exec("SET CHARACTER_SET 'utf8'");
$dbh->exec("SET CHARACTER_SET_CLIENT='utf8'");
$dbh->exec("SET CHARACTER_SET_RESULTS='utf8'");
$dbh->exec("SET COLLATION_CONNECTION='utf8_general_ci'");

$stmt = $dbh->prepare('SELECT * FROM config WHERE config_name=?');
$stmt->execute(array("client_name"));
$client_name = $stmt->fetch();
$xml_file_name = 'data_'.$client_name['config_value'].'.xml';

// CREATION DU FICHIER XML
if(isset($_POST['record_and_update'])) {
	$writer = new XMLWriter();
	$writer->openURI($xml_file_name);
	$writer->startDocument('1.0','UTF-8');
	$writer->setIndent(4);
	$writer->startElement('SETTINGS');
	$writer->startElement('TEXT');
	$writer->writeCData($_POST['texte']);
	$writer->endElement();
	$datetime = 0;
	if(isset($_POST['datetime'])) { $datetime = 1; }
	$writer->writeElement ('DATETIME',$datetime);
	$writer->endElement();
	$writer->endElement();
	$writer->flush();
}

// CREATION DU FICHIER XML - 2
if(isset($_POST['print'])) {
	$stmt = $dbh->prepare('SELECT * FROM layout WHERE id=?');
	$stmt->execute(array($_POST['layout_id']));
	$detail = $stmt->fetch();
	$text = $detail['text'];
	$writer = new XMLWriter();
	$writer->openURI($xml_file_name);
	$writer->startDocument('1.0','UTF-8');
	$writer->setIndent(4);
	$writer->startElement('SETTINGS');
	$writer->startElement('TEXT');
	$writer->writeCData($text);
	$writer->endElement();
	$datetime = 0;
	if(isset($_POST['datetime'])) { $datetime = 1; }
	$writer->writeElement ('DATETIME',$datetime);
	$writer->endElement();
	$writer->endElement();
	$writer->flush();
}

// LOGIN
if(isset($_POST['login_submit'])) {
	$stmt = $dbh->prepare('SELECT * FROM user WHERE username=? AND password=?');
	$stmt->execute(array($_POST['login_username'],md5($_POST['login_password'])));
	$detail = $stmt->fetchAll();
	if(count($detail)==1) {
		$stmt = $dbh->prepare('SELECT * FROM user WHERE username=? AND password=?');
		$stmt->execute(array($_POST['login_username'],md5($_POST['login_password'])));
		$detail = $stmt->fetch();
		$_SESSION['user_id'] = $detail['id'];
		$_SESSION['user_username'] = $detail['username'];
	}
}

// LOGOFF
if(isset($_POST['logoff'])) {
	unset($_SESSION['user_id']);
}

// AFFICHAGE D'UN LAYOUT POUR MODIFICATION (APPEL AJAX)
if(isset($_POST['action']) and $_POST['action']=="select") {
	$stmt = $dbh->prepare('SELECT * FROM layout WHERE id=?');
	$stmt->execute(array($_POST['layout_id']));
	$detail = $stmt->fetch();
	$text = $detail['text'];
	echo json_encode(array("name" => $detail['name'], "text" => $detail['text'], "datetime" => $detail['datetime']));
}

// AFFICHAGE D'UN USER POUR MODIFICATION (APPEL AJAX)
if(isset($_POST['action']) and $_POST['action']=="select_user") {
	$stmt = $dbh->prepare('SELECT * FROM user WHERE id=?');
	$stmt->execute(array($_POST['user_id']));
	$detail = $stmt->fetch();
	echo json_encode(array("username" => $detail['username']));
}

// MISE A JOUR DES PARAMETRES
if(isset($_POST['parameters_edit'])) {
	$stmt = $dbh->prepare('TRUNCATE config');
	$stmt->execute(array());
	$list_value = array("mode","server_address","client_name");
	for($i=0;$i<count($list_value);$i++) {
		$stmt = $dbh->prepare('INSERT INTO config (config_name,config_value) VALUES (?,?)');
		$stmt->execute(array($list_value[$i],$_POST[$list_value[$i]]));
	}
	
}

// CREATION D'UN LAYOUT
if(isset($_POST['action']) and $_POST['action']=="add") {
	if(isset($_POST['datetime'])) { $datetime = 1; } else { $datetime = 0; }
	$stmt = $dbh->prepare('INSERT INTO layout (name,text,datetime) VALUES (?,?,?)');
	$stmt->execute(array($_POST['name'],$_POST['texte'],$datetime));
}

// MODIFICATION D'UN LAYOUT
if(isset($_POST['action']) and $_POST['action']=="edit") {
	if(isset($_POST['datetime'])) { $datetime = 1; } else { $datetime = 0; }
	$stmt = $dbh->prepare('UPDATE layout SET name=?,text=?,datetime=? WHERE id=?');
	$stmt->execute(array($_POST['name'],$_POST['texte'],$datetime,$_POST['id']));
}

// SUPPRESSION D'UN LAYOUT
if(isset($_POST['delete_confirm'])) {
	$stmt = $dbh->prepare('UPDATE layout SET active=0 WHERE id=?');
	$stmt->execute(array($_POST['delete_confirm']));

}

// CREATION / SUPPRESSION D'UN USER
if(isset($_POST['user_edit'])) {
	
	// MODIFICATION D'UN USER
	if(isset($_POST['user_id']) and $_POST['user_id']!="") {
		$stmt = $dbh->prepare('UPDATE user SET username=? WHERE id=?');
		$stmt->execute(array($_POST['username'],$_POST['user_id']));
		if(isset($_POST['password']) and $_POST['password']!="") {
			$stmt = $dbh->prepare('UPDATE user SET password=? WHERE id=?');
			$stmt->execute(array(md5($_POST['password']),$_POST['user_id']));
		}
	} else { // CREATION D'UN USER
		$stmt = $dbh->prepare('INSERT INTO user (username,password) VALUES (?,?)');
		$stmt->execute(array($_POST['username'],md5($_POST['password'])));
	}
}

// CREATION / SUPPRESSION D'UN ECRAN
if(isset($_POST['screen_edit'])) {
	
	// MODIFICATION D'UN ECRAN
	if(isset($_POST['screen_id']) and $_POST['screen_id']!="") {
		$stmt = $dbh->prepare('UPDATE screen SET screen_name=?,screen_width=?,screen_height=? WHERE screen_id=?');
		$stmt->execute(array($_POST['screen_name'],$_POST['screen_width'],$_POST['screen_height'],$_POST['screen_id']));
	} else { // CREATION D'UN USER
		$stmt = $dbh->prepare('INSERT INTO screen (screen_name,screen_width,screen_height) VALUES (?,?,?)');
		$stmt->execute(array($_POST['screen_name'],$_POST['screen_width'],$_POST['screen_height']));
	}
}

// SUPPRESSION D'UN USER
if(isset($_POST['user_delete'])) {
	$stmt = $dbh->prepare('DELETE FROM user WHERE id=?');
	$stmt->execute(array($_POST['user_id']));
}

// SUPPRESSION D'UN ECRAN
if(isset($_POST['screen_delete'])) {
	$stmt = $dbh->prepare('DELETE FROM screen WHERE screen_id=?');
	$stmt->execute(array($_POST['screen_id']));
}

// AJOUT D'UNE IMAGE
if(isset($_POST['show_picture'])) {
	
	$target_dir = "upload/";
	$target_file = $target_dir . date("YmdHis") . "-" . basename($_FILES["picture_file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["picture_file"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["picture_file"]["size"] > 500000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Seuls les formats JPG, PNG et GIF sont autorisés.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["picture_file"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["picture_file"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}

// AJOUT D'UNE VIDEO
if(isset($_POST['show_video'])) {
	
	$target_dir = "upload/";
	$target_file = $target_dir . date("YmdHis") . "-" . basename($_FILES["video_file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["video_file"]["size"] > 500000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "mp4"
	) {
		echo "Seuls les formats JPG, PNG et GIF sont autorisés.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["video_file"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
	
if(isset($_POST['show_picture']) or isset($_POST['show_video'])) {
	$writer = new XMLWriter();
	$writer->openURI($xml_file_name);
	$writer->startDocument('1.0','UTF-8');
	$writer->setIndent(4);
	$writer->startElement('SETTINGS');
		$writer->startElement('TEXT');
	if(isset($_POST['show_picture'])) {
		$writer->text("image");
		$writer->endElement();
		$writer->startElement('IMAGE');
	}
	if(isset($_POST['show_video'])) {
		$writer->text("video");
		$writer->endElement();
		$writer->startElement('VIDEO');
	}
	$writer->writeCData($target_file);
	$writer->endElement();
	$datetime = 0;
	if(isset($_POST['datetime'])) { $datetime = 1; }
	$writer->writeElement ('DATETIME',$datetime);
	$writer->endElement();
	$writer->endElement();
	$writer->flush();
}


// AFFICHAGE D'UNE LANGUE POUR MODIFICATION (APPEL AJAX)
if(isset($_POST['action']) and $_POST['action']=="select_langue") {
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_id=?');
	$stmt->execute(array($_POST['langue_id']));
	$detail = $stmt->fetch();
	echo json_encode(array("langue_nom" => $detail['langue_nom'],"langue_texte_annuel" => $detail['langue_texte_annuel'],"langue_cantique" => $detail['langue_cantique'],"langue_id" => $detail['langue_id']));
}

// CREATION / SUPPRESSION D'UNE LANGUE
if(isset($_POST['langue_edit'])) {
	
	// MODIFICATION D'UNE LANGUE
	if(isset($_POST['langue_id']) and $_POST['langue_id']!="") {
		$stmt = $dbh->prepare('UPDATE langue SET langue_nom=?,langue_texte_annuel=?,langue_cantique=? WHERE langue_id=?');
		$stmt->execute(array($_POST['langue_nom'],$_POST['langue_texte_annuel'],$_POST['langue_cantique'],$_POST['langue_id']));
	} else { // CREATION D'UNE LANGUE
		$stmt = $dbh->prepare('INSERT INTO langue (langue_nom,langue_texte_annuel,langue_cantique) VALUES (?,?,?)');
		$stmt->execute(array($_POST['langue_nom'],$_POST['langue_texte_annuel'],$_POST['langue_cantique']));
	}
}

// SUPPRESSION D'UNE LANGUE
if(isset($_POST['langue_delete'])) {
	$stmt = $dbh->prepare('DELETE FROM langue WHERE langue_id=?');
	$stmt->execute(array($_POST['langue_id']));
}
