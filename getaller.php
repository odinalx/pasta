<?php
include_once('./admin/config/config.php');
//connexion à la base de données

try {
    $conn = new PDO("mysql:host=$HOST;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = $_REQUEST["q"];
    
    $stmt = $conn->prepare("SELECT `nom` FROM `allergènes` WHERE `nom` LIKE :q");
    $q = "$q%";
    $stmt->bindParam(':q', $q);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
          echo "<option value=\"" . $v["nom"] . "\">" . $v["nom"] . "</option>";
        }
    } 
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
