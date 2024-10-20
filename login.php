<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <form>
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
            <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</body>

</html>