<?php include('inc/fonctions.php'); ?>
<?php
$stmt = $dbh->prepare('SELECT * FROM config WHERE config_name=?');
$stmt->execute(array("client_name"));
$client_name = $stmt->fetch();
?>
<?php
$filename = 'data_'.$client_name['config_value'].'.xml';
if (file_exists($filename)) {
    print  filemtime($filename);
}
?>