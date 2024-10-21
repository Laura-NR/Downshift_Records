<?php
try {
  
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT * FROM record_Cd";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute();


    $cd = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

  
    print_r($cd);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


        