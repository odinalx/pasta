<?php 
const NOMFICH = 'userfile';

//transformer le fichier en untableau avec chaque ligne séparé
$table = [];
$test1 = file_get_contents($_FILES[NOMFICH]['tmp_name']);
$test2 = trim($test1," ");
$cherche = 'Œ';
$remplace = 'Oe';
if (($fichier = fopen($_FILES[NOMFICH]['tmp_name'],'r')) !== FALSE){
    while(($ligne = fgetcsv($fichier,null,"\t","\"")) !== FALSE){
        foreach ($ligne as $cle => $valeur) {
            $ligne[$cle] = str_replace($cherche, $remplace, $valeur);
        }
        $table[] = array_filter($ligne);
    }
    fclose($fichier);
}

//reprendre uniquement les pâtes françaises
$tablefr = []; 
for($i = 0; $i<count($table);$i++){
    if (isset($table[$i][3])){
        if ($table[$i][3]==='fr'){
             $tablefr[] = $table[$i];
        }
    }   
}
// Importe le fichier config.php qui doit comporter vos informations de connexion
include_once('./config/config.php');
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




//faire la requête d'insertion

for($j = 0; $j<count($tablefr); $j++) {
    $req = $bdd->prepare("INSERT INTO `produit`(`code`,`name`, `brand`, `store`, `allergènes`) VALUES (?,?,?,?,?)");
    if(isset($tablefr[$j][0])){$req->bindValue(1, $tablefr[$j][0], PDO::PARAM_STR);}else{$req->bindValue(1,"", PDO::PARAM_STR);};
    if(isset($tablefr[$j][15])){$req->bindValue(2, $tablefr[$j][15], PDO::PARAM_STR);}else{$req->bindValue(2,"", PDO::PARAM_STR);};    
    if(isset($tablefr[$j][77])){$req->bindValue(3, $tablefr[$j][77], PDO::PARAM_STR);}else{$req->bindValue(3,"", PDO::PARAM_STR);};
    if(isset($tablefr[$j][86])){$req->bindValue(4, $tablefr[$j][86], PDO::PARAM_STR);}else{$req->bindValue(4,"", PDO::PARAM_STR);};    
    if(isset($tablefr[$j][141])){$req->bindValue(5, $tablefr[$j][141], PDO::PARAM_STR);}else{$req->bindValue(5,"", PDO::PARAM_STR);};
    $req->execute();
} 

$tablealler = [];
for($j = 0; $j<count($tablefr); $j++){
    if(isset($tablefr[$j][141])){
        $tablealler[] = $tablefr[$j][141];
    }
}

$test ="";
$test = implode(",",$tablealler);
$test = trim($test,",");
$tablealler = explode(",",$test);
function trim_value(&$value)
{
    $value = trim($value);
}
array_walk($tablealler, 'trim_value');
$tablealler = array_unique($tablealler);
$tablealler = array_values($tablealler);
print_r($tablealler);

for($j = 0; $j<count($tablealler); $j++) {
    $req = $bdd->prepare("INSERT INTO `allergènes`(`nom`) VALUES (?)");
    $req->bindValue(1, $tablealler[$j], PDO::PARAM_STR);
    $req->execute();
}


$tablestore = [];
for($j = 0; $j<count($tablefr); $j++){
    if(isset($tablefr[$j][86])){
        $tablestore[] = $tablefr[$j][86];
    }
}

$test ="";
$test = implode(",",$tablestore);
$test = trim($test,",");
$tablestore = explode(",",$test);
array_walk($tablestore,'trim_value');
$tablestore = array_unique($tablestore);
$tablestore = array_values($tablestore);
//print_r($tablestore);



for($j = 0; $j<count($tablestore); $j++) {
    $req = $bdd->prepare("INSERT INTO `store`(`nom`) VALUES (?)");
    $req->bindValue(1, $tablestore[$j], PDO::PARAM_STR);
    $req->execute();
}


$tablesbrand = [];
for($j = 0; $j<count($tablefr); $j++){
    if(isset($tablefr[$j][77])){
        $tablesbrand[] = $tablefr[$j][77];
    }
}


$test ="";
$test = implode(",",$tablesbrand);
$test = trim($test,",");
$tablesbrand = explode(",",$test);
array_walk($tablesbrand,'trim_value');
$tablesbrand = array_unique($tablesbrand);
$tablesbrand = array_values($tablesbrand);
//print_r($$tablesbrand);



for($j = 0; $j<count($tablesbrand); $j++) {
    $req = $bdd->prepare("INSERT INTO `marque`(`brand`) VALUES (?)");
    $req->bindValue(1, $tablesbrand[$j], PDO::PARAM_STR);
    $req->execute();
}