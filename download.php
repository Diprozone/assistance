<?php

$dbh = new PDO('mysql:host=mysql-tomus.alwaysdata.net;dbname=tomus_nuit', 'tomus', 'oui');
$stmt = $dbh->prepare("SELECT * FROM utilisateurs WHERE id ='".$_GET['id']."'");
$stmt->execute();
$user = $stmt->fetch();

$stmt = $dbh->prepare("SELECT * FROM historique WHERE id_user ='".$_GET['id']."' ORDER BY date DESC");
$stmt->execute();
$hist = $stmt->fetchAll();
$file = '== Données de ' . $user['prenom'] . ' ' . $user['nom'] . " ==\r\n\r\n";
$file .= 'Activite | Vigilance | Conscience | BPM | Température du corps °C |      Date' . "\r\n";
foreach ($hist as $value) {
    $file .= str_repeat(' ', max(0, 7 - strlen($value['activite']))) . $value['activite'] . "  |";
    $file .= str_repeat(' ', max(0, 8 - strlen($value['vigilance']))) . $value['vigilance'] . "   |";
    $file .= str_repeat(' ', max(0, 9 - strlen($value['conscience']))) . $value['conscience'] . "   |";
    $file .= str_repeat(' ', max(0, 4 - strlen($value['freq']))) . $value['freq'] . " |";
    $file .= str_repeat(' ', max(0, 20 - strlen($value['tempcorp']))) . $value['tempcorp'] . "     |";
    $file .= " ". $value['date'] . "\r\n";
}



header('Content-Disposition: attachment; filename="'.$user['prenom']. ' ' . $user['nom'].'.txt"');
header('Content-Type: text/plain'); # Don't use application/force-download - it's not a real MIME type, and the Content-Disposition header is sufficient
header('Content-Length: ' . strlen($file));
header('Connection: close');


echo $file;


