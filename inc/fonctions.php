<?php
// LANCEMENT DE LA SESSION
session_start();

// CONNEXION A LA BASE DE DONNEES
switch($_SERVER['SERVER_NAME']) {
	case "ds4kh.dev" : $user = "root";$pass = "";break;
	case "ds4kh.mesvideos.org" : $user = "ds4kh";$pass = "ds4kh";break;
	default : $user = "root";$pass = "alctj";break;
}
$dbh = new PDO('mysql:host=localhost;dbname=signage', $user, $pass);
$dbh->exec("SET NAMES 'utf8'");
$dbh->exec("SET CHARACTER_SET 'utf8'");
$dbh->exec("SET CHARACTER_SET_CLIENT='utf8'");
$dbh->exec("SET CHARACTER_SET_RESULTS='utf8'");
$dbh->exec("SET COLLATION_CONNECTION='utf8_general_ci'");

// MISE A JOUR DE LA BASE DE DONNEES
if(isset($_POST['database_update'])) {
	$filename = 'ds4kh.sql';
	$templine = '';
	$lines = file($filename);
	foreach ($lines as $line) {
		if (substr($line, 0, 2) == '--' || $line == '') {
			continue;
		} else {
			$templine .= $line;
		}
		if (substr(trim($line), -1, 1) == ';') {
			$stmt = $dbh->prepare($templine);
			$stmt->execute();
			$templine = '';
		}
	}
}

// MISE A JOUR DU SYSTEME
if(isset($_POST['system_update'])) {
	$folder = $_SERVER['DOCUMENT_ROOT'];
	$commande = "cd ".$folder.";git -c diff.mnemonicprefix=false -c core.quotepath=false fetch origin;git -c diff.mnemonicprefix=false -c core.quotepath=false pull origin master;git -c diff.mnemonicprefix=false -c core.quotepath=false submodule update --init --recursive;";	
	exec($commande);
}
	
$xml_file_name = 'data.xml';

// AFFICHAGE D'UN TEXTE
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

// AFFICHAGE D'UN CANTIQUE
if(isset($_POST['cantique'])) {
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_id=?');
	$stmt->execute(array($_POST['langue_id']));
	$detail = $stmt->fetch();
	$text = "";
	$text .= '<span style="font-size: 124pt;">';
	$text .= "<br>";
	$text .= $detail['langue_cantique'];
	$text .= "<br>";
	$text .= $_POST['cantique'];
	$text .= '</span>';
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

// AFFICHAGE D'UNE LANGUE
if(isset($_POST['print_langue'])) {
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_id=?');
	$stmt->execute(array($_POST['langue_id']));
	$detail = $stmt->fetch();
	$text = $detail['langue_texte_annuel'];
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
	header("Location:index.php");
}

// ADMINISTRATION
if(isset($_POST['administration'])) {
	header("Location:admin.php");
}

// UTILISATION
if(isset($_POST['utilisation'])) {
	header("Location:index.php");
}

// AJOUT D'UNE IMAGE
if(isset($_POST['show_picture'])) {
	$target_dir = "upload/";
	$files = glob($target_dir."*");
	foreach($files as $file){
		if(is_file($file))
		unlink($file);
	}
	$target_file = $target_dir . date("YmdHis") . "-" . basename($_FILES["picture_file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["picture_file"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;
	} else {
		echo "Ce fichier n'est pas une image (.jpg ou .png).";
		$uploadOk = 0;
	}
	if ($_FILES["picture_file"]["size"] > 500000000) {
		echo "La taille du fichier doit être inférieur à 500Mo.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png") {
		echo "Seuls les formats .jpg et .png sont autorisés.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "Ce fichier n'a pas été envoyé. L'écran ne pourra pas être mis à jour.";
	} else {
		if (move_uploaded_file($_FILES["picture_file"]["tmp_name"], $target_file)) {
		} else {
			echo "Ce fichier n'a pas été envoyé. L'écran ne pourra pas être mis à jour.";
		}
	}
}
//

// AFFICHAGE D'UN MEDIA
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
	$writer->writeCData($target_file);
	$writer->endElement();
	$datetime = 0;
	if(isset($_POST['datetime'])) { $datetime = 1; }
	$writer->writeElement ('DATETIME',$datetime);
	$writer->endElement();
	$writer->endElement();
	$writer->flush();
}

// ADMINISTRATION

// AFFICHAGE D'UNE LANGUE POUR MODIFICATION (APPEL AJAX)
if(isset($_POST['action']) and $_POST['action']=="select_langue") {
	$stmt = $dbh->prepare('SELECT * FROM langue WHERE langue_id=?');
	$stmt->execute(array($_POST['langue_id']));
	$detail = $stmt->fetch();
	echo json_encode(array("langue_nom" => $detail['langue_nom'],"langue_texte_annuel" => $detail['langue_texte_annuel'],"langue_cantique" => $detail['langue_cantique'],"langue_id" => $detail['langue_id']));
}

// CREATION / MODIFICATION D'UNE LANGUE
if(isset($_POST['langue_edit'])) {
	
	if(isset($_POST['langue_id']) and $_POST['langue_id']!="") {
		$stmt = $dbh->prepare('UPDATE langue SET langue_nom=?,langue_texte_annuel=?,langue_cantique=? WHERE langue_id=?');
		$stmt->execute(array($_POST['langue_nom'],$_POST['langue_texte_annuel'],$_POST['langue_cantique'],$_POST['langue_id']));
	} else {
		$stmt = $dbh->prepare('INSERT INTO langue (langue_nom,langue_texte_annuel,langue_cantique) VALUES (?,?,?)');
		$stmt->execute(array($_POST['langue_nom'],$_POST['langue_texte_annuel'],$_POST['langue_cantique']));
	}
}

// SUPPRESSION D'UNE LANGUE
if(isset($_POST['langue_delete'])) {
	$stmt = $dbh->prepare('DELETE FROM langue WHERE langue_id=?');
	$stmt->execute(array($_POST['langue_id']));
}

// AFFICHAGE D'UN USER POUR MODIFICATION (APPEL AJAX)
if(isset($_POST['action']) and $_POST['action']=="select_user") {
	$stmt = $dbh->prepare('SELECT * FROM user WHERE id=?');
	$stmt->execute(array($_POST['user_id']));
	$detail = $stmt->fetch();
	echo json_encode(array("username" => $detail['username']));
}

// CREATION / MODIFICATION D'UN UTILISATEUR
if(isset($_POST['user_edit'])) {
	if(isset($_POST['user_id']) and $_POST['user_id']!="") {
		$stmt = $dbh->prepare('UPDATE user SET username=? WHERE id=?');
		$stmt->execute(array($_POST['username'],$_POST['user_id']));
		if(isset($_POST['password']) and $_POST['password']!="") {
			$stmt = $dbh->prepare('UPDATE user SET password=? WHERE id=?');
			$stmt->execute(array(md5($_POST['password']),$_POST['user_id']));
		}
	} else {
		$stmt = $dbh->prepare('INSERT INTO user (username,password) VALUES (?,?)');
		$stmt->execute(array($_POST['username'],md5($_POST['password'])));
	}
}

// SUPPRESSION D'UN UTILISATEUR
if(isset($_POST['user_delete'])) {
	$stmt = $dbh->prepare('DELETE FROM user WHERE id=?');
	$stmt->execute(array($_POST['user_id']));
}