<?php //require $_SERVER['DOCUMENT_ROOT']."assist/jpgraph/jpgraph.php";
//require $_SERVER['DOCUMENT_ROOT']."assist/jpgraph/jpgraph_line.php";
//
//$pdo = new PDO('mysql:host=mysql-tomus.alwaysdata.net;dbname=tomus_nuit', 'tomus', 'oui');
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//$q = $pdo->query('SELECT * FROM historique WHERE id_user = 1');
//$nom = $pdo->query('SELECT * FROM utilisateurs WHERE id = 1');
//
//$nom = $nom->fetch();
//$q = $q->fetchAll();
//$activite = [];
//$vigilance = [];
//$conscience = [];
//$freq = [];
//$tempcorp = [];
//$date = [];
//
//foreach ($q as $value) {
//    array_push($activite, $value['activite']);
//    array_push($vigilance, $value['vigilance']);
//    array_push($conscience, $value['conscience']);
//    array_push($freq, $value['freq']);
//    array_push($tempcorp, $value['tempcorp']);
//    array_push($date, date('d-m-Y', strtotime($value['date'])));
//}
//
//// Setup the graph
//$graph = new Graph(1280,720);
//$graph->SetScale("textlin");
//
//$theme_class=new UniversalTheme;
//
//$graph->SetTheme($theme_class);
//$graph->img->SetAntiAliasing(false);
//$graph->title->Set('Courbes de données de ' . $nom['prenom'] . ' ' . $nom['nom']);
//$graph->SetBox(false);
//
//$graph->SetMargin(40,20,36,63);
//
//$graph->img->SetAntiAliasing();
//
//$graph->yaxis->HideZeroLabel();
//$graph->yaxis->HideLine(false);
//$graph->yaxis->HideTicks(false,false);
//
//$graph->xgrid->Show();
//$graph->xgrid->SetLineStyle("solid");
//$graph->xaxis->SetTickLabels($date);
//$graph->xgrid->SetColor('#E3E3E3');
//
//// Create the first line
//$p1 = new LinePlot($activite);
//$graph->Add($p1);
//$p1->SetColor("#FF0000");
//$p1->SetLegend('Activité');
//
//$p2 = new LinePlot($vigilance);
//$graph->Add($p2);
//$p2->SetColor("#FF00FF");
//$p2->SetLegend('Vigilance');
//
//$p3 = new LinePlot($conscience);
//$graph->Add($p3);
//$p3->SetColor("#00FF00");
//$p3->SetLegend('Conscience');
//
//$p4 = new LinePlot($freq);
//$graph->Add($p4);
//$p4->SetColor("#00FFFF");
//$p4->SetLegend('Fréquence cardiaque');
//
//$p5 = new LinePlot($tempcorp);
//$graph->Add($p5);
//$p5->SetColor("#0000FF");
//$p5->SetLegend('Température corporelle');
//
//$graph->legend->SetFrameWeight(1);
//// Output line
//unlink('img/' . $nom['id'] . '.png');
//$graph->Stroke('img/' . $nom['id'] . '.png');
// Output line
?>
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
<div class="container">
  <h1 class="text-center text-white mt-5"> Assistance de vie </h1>

  <div class="container">

    <div class="row align-content-center mt-5 mb-5">
      <div class="col-sm-4 ">
        <div class="card " style="width: 18rem;">
          <img class=" card-img-top" src="img/steph.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Stéphane Lévin</h5>
            <p class="card-text">Meme pas besoin de le présenter ! 15 ans de metier</p>
          </div>
          <div class="card-body h-25">
            <a href="aventurier.php?nom=Levin" class="card-link"> d Comment va-t-il ?</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top h-100" src="img/xav.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Xavier Maisse</h5>
            <p class="card-text">Un de nos plus grand aventurier, il n'a peur de rien !</p>
          </div>
          <div class="card-body">
            <a href="aventurier.php?nom=Maisse" class="card-link">  Comment va-t-il ?</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="img/quentin.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Quentin Pla</h5>
            <p class="card-text">Le nouveau de la bande, très prometteur. Expert des milieux insonorisé.</p>
          </div>
          <div class="card-body">
            <a href="aventurier.php?nom=Pla" class="card-link">  Comment va-t-il ?</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row align-content-center mt-5">
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="img/tom.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Thomas Miceli</h5>
            <p class="card-text">Codeur php convertit dans l'aventure !</p>
          </div>
          <div class="card-body">
            <a href="aventurier.php?nom=Miceli" class="card-link">  Comment va-t-il ?</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="img/greg.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Grégory Nam</h5>
            <p class="card-text">Le meilleur</p>
          </div>
          <div class="card-body">
            <a href="aventurier.php?nom=Nam" class="card-link">  Comment va-t-il ?</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="img/axel.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Axel AMAM</h5>
            <p class="card-text">Expert des pays chaud tel que le magrheb</p>
          </div>
          <div class="card-body">
            <a href="aventurier.php?nom=Amghar" class="card-link">  Comment va-t-il ?</a>
          </div>
        </div>
      </div>
    </div>



  </div>


</div>



</body>
</html>
