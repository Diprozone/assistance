<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assistance vie</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body class="bg-dark">

<?php

require $_SERVER['DOCUMENT_ROOT']."assist/jpgraph/jpgraph.php";
require $_SERVER['DOCUMENT_ROOT']."assist/jpgraph/jpgraph_line.php";

$dbh = new PDO('mysql:host=mysql-tomus.alwaysdata.net;dbname=tomus_nuit', 'tomus', 'oui');

$stmt = $dbh->prepare("SELECT id FROM utilisateurs WHERE nom ='".$_GET['nom']."'");

$stmt->execute();
$id_user = $stmt->fetch();



$stmt = $dbh->prepare("SELECT * FROM historique WHERE id_user=".$id_user['id']." ORDER BY date desc LIMIT 1");
$stmt->execute();
$donnes = $stmt->fetch();


$activite = $donnes['activite'];
$vigilance = $donnes['vigilance'];
$conscience = $donnes['conscience'];
$freq = $donnes['freq'];
$tempcorp = $donnes['tempcorp'];
$date = $donnes['date'];


$date_courante = new DateTime(date("Y-m-d H:i:s"));
$date_reference = new DateTime($date);
$interval = $date_courante->diff($date_reference);


if($interval->format('%a') >= 1)
{
    $colormvt = "danger";

}
else
{
    $colormvt = "success";
}

if($activite <= 25 )
{
    $colorbaractivite = "danger";
}
else if($activite > 75 ) {
    $colorbaractivite = "success";
}
else
{
    $colorbaractivite = "warning";
}

if($vigilance <= 25)
{
    $colorbarvigilance = "danger";
}
else if($vigilance >75) {
    $colorbarvigilance = "success";
}
else
{
    $colorbarvigilance = "warning";
}

if($conscience <= 25)
{
    $colorbarconscience = "danger";
}
else if($conscience >75) {
    $colorbarconscience = "success";
}
else
{
    $colorbarconscience = "warning";
}




if($freq > 50 && $freq < 80)
{
    $colorfreq = "success";
}
else if($freq < 140) {
$colorfreq = "warning";
}
else
{
$colorfreq = "danger";
}

if($tempcorp > 35 && $tempcorp< 40)
{
    $colortemp = "success";
}
else if($tempcorp < 42 || $tempcorp > 32) {
    $colortemp = "warning";
}
else
{
    $colortemp = "danger";
}

$today = date("Y-m-d");

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$q = $dbh->query("SELECT * FROM historique WHERE id_user =".$id_user['id']);
$nom = $dbh->query('SELECT * FROM utilisateurs WHERE id = '.$id_user['id']);

$nom = $nom->fetch();
$q = $q->fetchAll();
$activite2 = [];
$vigilance2 = [];
$conscience2 = [];
$freq2 = [];
$tempcorp2 = [];
$date2 = [];

foreach ($q as $value) {
    array_push($activite2, $value['activite']);
    array_push($vigilance2, $value['vigilance']);
    array_push($conscience2, $value['conscience']);
    array_push($freq2, $value['freq']);
    array_push($tempcorp2, $value['tempcorp']);
    array_push($date2, date('d-m-Y', strtotime($value['date'])));
}

// Setup the graph
$graph = new Graph(1280,720);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Courbes de données de ' . $nom['prenom'] . ' ' . $nom['nom']);
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($date2);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($activite2);
$graph->Add($p1);
$p1->SetColor("#FF0000");
$p1->SetLegend('Activité');

$p2 = new LinePlot($vigilance2);
$graph->Add($p2);
$p2->SetColor("#FF00FF");
$p2->SetLegend('Vigilance');

$p3 = new LinePlot($conscience2);
$graph->Add($p3);
$p3->SetColor("#00FF00");
$p3->SetLegend('Conscience');

$p4 = new LinePlot($freq2);
$graph->Add($p4);
$p4->SetColor("#00FFFF");
$p4->SetLegend('Fréquence cardiaque');

$p5 = new LinePlot($tempcorp2);
$graph->Add($p5);
$p5->SetColor("#0000FF");
$p5->SetLegend('Température corporelle');

$graph->legend->SetFrameWeight(1);
// Output line
unlink('img/' . $nom['id'] . '.png');
$graph->Stroke('img/' . $nom['id'] . '.png');


?>







<div class="container">
    <h1 class="text-center text-white mt-5"> Assistance de vie de <?php echo $_GET['nom'];?> </h1>

    <a class="btn btn-info w-100" href="download.php?id=<?= $id_user['id']?>">Télécharger les données</a>
    <div class="container">


        <h2 class="text-center mt-5 text-<?php echo $colorbaractivite;?>    ">
            Activité
        </h2>

        <div class="progress mt-5 mb-5 ">
            <div class="progress-bar bg-<?php echo $colorbaractivite;?> " role="progressbar" style="width: <?php echo $activite;?>%;" aria-valuenow="<?php echo $activite;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $activite;?>%</div>
        </div>

        <h2 class="text-center text-<?php echo $colorbarvigilance;?>">
            Vigilance
        </h2>


        <div class="progress mt-5 mb-5">
            <div class="progress-bar bg-<?php echo $colorbarvigilance;?>" role="progressbar" style="width: <?php echo $vigilance;?>%;" aria-valuenow="<?php echo $vigilance;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $vigilance;?>%</div>
        </div>


        <h2 class="text-center text-<?php echo $colorbarconscience;?>">
            Conscience
        </h2>

        <div class="progress mt-5 mb-5" >
            <div class="progress-bar bg-<?php echo $colorbarconscience;?>" role="progressbar" style="width: <?php echo $conscience;?>%;" aria-valuenow="<?php echo $conscience;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $conscience;?>%</div>
        </div>


        <div class ="row">
            <div class="col-sm-4 mt-5">
                <div class="card text-white bg-<?php echo $colorfreq;?> mb-3" style="max-width: 18rem;">
                    <div class="card-header">Frequence cardiaque</div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $freq." bpm";?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-5">
                <div class="card text-white bg-<?php echo $colormvt;?> mb-3" style="max-width: 18rem;">
                    <div class="card-header text-truncate"> Dernier mouvement </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $date;?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-5">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">Temperature corporelle</div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $tempcorp." °C"; ?></p>
                    </div>
                </div>
            </div>

        </div>
        <h2 class="mt-5 mb-5 text-center text-white"> Historique des données</h2>
        <div class="text-center mb-5">
            <img src="img/<?php echo $id_user['id'].".png";?>" class="rounded img-fluid" alt="...">
        </div>

    </div>


</div>



</body>
</html>
