<div>
    <p><?= $data["data"]["error"] ?></p>
    <form action="index.php" method="post">
        <label for="name">Nom d'utilisateur</label><input type="text" name="name" id="name">
        <label for="pass">Mot de passe</label><input type="password" name="pass" id="pass">
        <input type="hidden" name="a" value="connect">
        <input type="hidden" name="r" value="auth">
        <input type="submit" value="Se connecter">
    </form>
</div>