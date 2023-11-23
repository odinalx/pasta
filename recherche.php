<!DOCTYPE html>
<html>
<head>
    <title>Menus déroulants responsives</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style/style.css">
  <link rel="shortcut icon" type="image/png" href="image/logo.png"/>
  <script defer src="./script/script.js"></script>
</head>
<body>
<?php 
include_once('./admin/config/config.php');
//connexion à la base de données
$bdd = null;
		
try {
    $bdd = new PDO(
        'mysql:host='.$HOST.';dbname='.$DATABASE,
        $USER,
        $PASSWORD
    );
} catch (PDOException $e){
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
<?php
    if(isset($_POST["brand"])){
      $req = $bdd->prepare("SELECT * FROM `produit` WHERE `brand` LIKE ? AND `store` LIKE ? AND `allergènes` NOT LIKE ? AND `allergènes` NOT LIKE ? AND `allergènes` NOT LIKE ?;");
      if(isset($_POST["brand"])){$req->bindValue(1, '%'.$_POST["brand"].'%', PDO::PARAM_STR);}else{$req->bindValue(1,"%%", PDO::PARAM_STR);};
      if(isset($_POST["store"])){$req->bindValue(2, '%'.$_POST["store"].'%', PDO::PARAM_STR);}else{$req->bindValue(2,"%%", PDO::PARAM_STR);};
      if(isset($_POST["allergènes1"])&& !empty($_POST["allergènes1"])){$req->bindValue(3, '%' . $_POST["allergènes1"] . '%', PDO::PARAM_STR);}else{$req->bindValue(3,"%/%", PDO::PARAM_STR);}; 
      if(isset($_POST["allergènes2"])&& !empty($_POST["allergènes2"])){$req->bindValue(4, '%' . $_POST["allergènes2"] . '%', PDO::PARAM_STR);}else{$req->bindValue(4,"%/%", PDO::PARAM_STR);};
      if(isset($_POST["allergènes3"])&& !empty($_POST["allergènes3"])){$req->bindValue(5, '%' . $_POST["allergènes3"] . '%', PDO::PARAM_STR);}else{$req->bindValue(5,"%/%", PDO::PARAM_STR);};  
      $req->execute();
      $data = $req->fetchAll();
      unset($_POST);
    }
?>
    <header>
        <nav>
            <img class="leftnav" src="./img/logo.png">
            <p class="leftnav2">PastAdventure</p>
            <div class="menu">
                <ul>
                    <li class="box">
                        <a href="index.html">Accueil </a>
                    </li>
                    <li class="box">
                        <a href="recherche.php">Passe ta recherche </a>
                    </li>
                    <li class="box">
                        <a href="contact.html">Contact </a>
                    </li>
                </ul>
            </div>
            <button class="hamburger ">
                <span></span>
                <span></span>
                <span></span>
            </button>  
       </nav>
       <div class="mobile-menu">
        <ul>
            <li class="box">
                <a href="index.html">Accueil </a>
            </li>
            <li class="box">
                <a href="recherche.php"> Passe ta recherche </a>
            </li>
            <li class="box">
                <a href="contact.html"> Contact </a>
            </li>
        </ul>
    </div>
  </header>

    



<div class="texte1">Recherchez tous les allergènes que contiennent vos pâtes !</div>
<form method="POST" action="" class="test1">
    <div class="wrap">
        <div class="search">
           <input list="resultatstore" name="store" id="store" class="searchTerm" placeholder="Recherchez votre enseigne..." onkeyup="autocompletionstore()">
           <datalist id="resultatstore"></datalist>
        </div>
     </div>

    <div class="wrap1">
        <div class="search">
           <input list="resultatbrand" name="brand" id="brand" class="searchTerm" placeholder="Recherchez votre marque..." onkeyup="autocompletionbrand()">
           <datalist id="resultatbrand"></datalist>
        </div>
     </div>

    <div class="dropdown">
        <div class="searchTerm">Recherchez vos allergènes</div>
        <div class="dropdown-content">
          <label for="option1">
            <input list="resultataller1" id="aller1" name="allergènes1" onkeyup="autocompletionaller1()">
            <datalist id="resultataller1"></datalist>
          </label><br>
          <label for="option2">
            <input list="resultataller2" id="aller2" name="allergènes2" onkeyup="autocompletionaller2()">
            <datalist id="resultataller2"></datalist>
          </label><br>
          <label for="option3">
            <input list="resultataller3" id="aller3" name="allergènes3" onkeyup="autocompletionaller3()">
            <datalist datalist id="resultataller3"></datalist>
          </label><br>
        </div>
    </div>
    <div class="emoji-pasta">
        <div class="emoji-container">
            <div class="slot"></div>
            <input type="submit" value="✅" class="btn-confettis"></input>
        </div>
    </div>
</form>
<?php 
if(isset($data)){

echo("<table>
    <thead>
        <tr>
            <th>Pâtes</th>
            <th>Marque</th>
            <th>Magasin</th>
            <th>Allergènes</th>
        </tr>
    </thead>");
    for($i = 0; $i<count($data); $i++){
        $name = $data[$i]['name'];
        $brand = $data[$i]['brand'];
        $store = $data[$i]['store'];
        $allergenes = $data[$i]['allergènes'];
        echo "
        <tbody>
        <?php  ?>
        <tr>
            <td>$name</td>
            <td>$brand</td>
            <td>$store</td>
            <td>$allergenes</td>
        </tr>"
    ;};
    echo "</tbody>
</table>";}; ?>



   


      
</body>
</html>