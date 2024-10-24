<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
  <title><?= constant('WEBSITE_TITLE') ?></title>
</head>

<body class="container">
  <main>
    <form action="process_registration.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Nom d'Utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" />
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse Mail</label>
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          aria-describedby="emailHelp" />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mot de Passe</label>
        <input type="password" class="form-control" id="password" name="password" />
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirmer Mot de Passe</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" />
      </div>
      <button type="submit" class="btn btn-primary">Créer compte</button>
    </form>
  </main>
  <footer class="text-body-secondary py-5">
    <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
  </footer>

</body>

</html>