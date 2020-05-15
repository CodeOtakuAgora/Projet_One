<!-- si l'utilsateur n'a pas clické -->
<?php if (!isset($_COOKIE['cdd'])): ?>
    <div class="cookie-alert">
        <p>Mon site utilise des cookies pour vous offrir le meilleur service possible. En continuant votre navigation,
            vous en acceptez l'utilisation.
            <?php if (!isset($titleAdminCrud)) { ?>
            <a href="include/accept_cookie.php">OK</a></p>
        <!-- si on se trouve dans le répertoire du crud alors il faut sortir du dossier crud -->
        <!-- c'est pourquoi on utilise le ../ pour revenir à la racine du site -->
        <?php } else { ?>
            <a href="../include/accept_cookie.php">OK</a></p>
        <?php } ?>
    </div>
    <!-- fin du if -->
<?php endif; ?>

<style type="text/css">
    footer {
        padding-top: 50px;
        position: relative;
        bottom: 0
    }

    .copyright {
        position: fixed;
        display: block;
        bottom: 0;
        color: white;
        background-color: blue;
        width: 100%;
    }
</style>

<footer>
    <div class="copyright">
        <p style="text-align: center">&copy; 2019 hwear.fr</p>
    </div>

</footer>


</body>
</html>