<div>
    <p><?= $data["data"]["error"] ?></p>
    <form action="index.php" method="post">
        <label for="name">Nom d'utilisateur</label><input type="text" name="name" id="name">
        <label for="pass">Mot de passe</label><input type="password" name="pass" id="pass">
        <label for="pass2">Répéter mot de passe</label><input type="password" name="pass2" id="pass2">
        <label for="email">email</label><input type="email" name="email" id="email">
        <input type="hidden" name="a" value="create">
        <input type="hidden" name="r" value="auth">
        <input type="submit" value="S'inscrire">
    </form>
</div>