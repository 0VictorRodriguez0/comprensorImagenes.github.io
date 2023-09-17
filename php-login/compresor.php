<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compresión y Descarga de Imágenes</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/stylePage.css">
</head>
<body>


    <div class="container">
    <h1> Bienvenido <?= $user['email']; ?> </h1> 

        <h1>Compresión y Descarga de Imágenes</h1>
        <input type="file" id="input" accept=".jpg, .jpeg, .png">
       <a href="logout.php">
        Logout
        </a>
        <div id="wrapper"></div> 
    </div>
    <script src="app.js"></script>
</body>
</html>
