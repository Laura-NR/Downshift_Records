<?php require_once 'include.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <title><?= constant('WEBSITE_TITLE') ?></title>
</head>

<body>
  <main class="container" id="login_container">
    <form action="process_login.php" method="post">
      <div>
        <label for="username" class="form-label">Nom d'Utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" />
      </div>
      <div>
        <label for="exampleInputEmail1" class="form-label">Adresse Mail</label>
        <input
          type="email"
          class="form-control"
          id="email"
          name="email" />
      </div>
      <div>
        <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
        <input type="password" class="form-control" id="password" name="password" />
      </div>
      <a href="registration.php" id="redirect_to_register">Créer une nouvelle compte</a>
      <button type="submit" class="btn">Se connecter</button>
    </form>
  </main>
</body>

</html>