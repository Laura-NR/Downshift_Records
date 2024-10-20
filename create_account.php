<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création du compte</title>
</head>

<body>
    <form action="process_registration.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'Utilisateur</label>
            <input type="text" class="form-control" id="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse Mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer Mot de Passe</label>
            <input type="password" class="form-control" id="confirm_password">
        </div>
        <button type="submit" class="btn btn-primary">Créer compte</button>
    </form>
</body>

</html>