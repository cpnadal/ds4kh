<?php include('inc/fonctions.php'); ?>
<?php
$filename = 'data.xml';
if (file_exists($filename)) {
    print  filemtime($filename);
}
?>