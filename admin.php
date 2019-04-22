<?php

    $titleAdmin = "Tableau de Bord";

    require_once('include/require.php');

    if (isset($_GET['type']) AND $_GET['type'] == 'users') {
        if (isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
            $approuve = (int)$_GET['approuve'];
            $req = Bdd::getInstance()->conn->prepare('UPDATE users SET approuve = 1 WHERE id = ?');
            $req->execute(array($approuve));
        }
        if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
            $supprime = (int)$_GET['supprime'];
            $req = Bdd::getInstance()->conn->prepare('DELETE FROM users WHERE id = ?');
            $req->execute(array($supprime));
        }
    } elseif (isset($_GET['type']) AND $_GET['type'] == 'produits') {
        if (isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $confirme = (int)$_GET['confirme'];
            $req = Bdd::getInstance()->conn->prepare('UPDATE produits SET confirme = 1 WHERE id = ?');
            $req->execute(array($confirme));
        }
        if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
            $supprime = (int)$_GET['supprime'];
            $req = Bdd::getInstance()->conn->prepare('DELETE FROM produits WHERE id = ?');
            $req->execute(array($supprime));
        }
    }
    $users = Bdd::getInstance()->conn->query('SELECT * FROM users ORDER BY id DESC');
    $produits = Bdd::getInstance()->conn->query('SELECT * FROM produits ORDER BY id DESC');

    function nbclients()
    {
        $request = Bdd::getInstance()->conn->query('SELECT COUNT(*) AS nbclients FROM `users`');
        $nbclients = $request->fetch();
        return $nbclients;
    }

    echo ' <div class=""content">
		<div style="display:flex;justify-content:center;">
		<a style="color:red;font-size:25px;" href="deconnection.php">SE DECONNECTER</a>
		</div>
	';
    echo
    '<div class="content">
        echo
        '<div class="content">
            <div class="contenupage">
		        <div class="container">
			        <div class="row">
			            <h1 align="center">Espace administration<div>
			            </div>
				            <div class="paneladmin">
				                <h3><a href="crud/index.php">Accéder au CRUD des users</a> </h3>
				
				                    Il y a ';
    $nbclients = nbclients();
    echo $nbclients['nbclients'], ' clients dans la base.
        $nbclients = nbclients();
        echo $nbclients['nbclients'], ' clients dans la base.
				</p>
				</div>
			</div>	
		</div>			
	</div>
		</div>';

?>

    <table align="center" border="10px">
        <tr>
            <th>Contenus</th>
            <th>Tables</th>
        </tr>
        <tr>
            <td>
                <?php while ($m = $users->fetch()) { ?>
                    <p align="center"><?php echo $m['id'] ?> : <?php echo $m['nom'] ?> (<?php echo $m['mail'] ?>
                        )<?php if ($m['approuve'] == 0) { ?> - <a
                                href="admin.php?type=users&approuve=<?php echo $m['id'] ?>">Confirmer</a><?php } ?> - <a
                                href="admin.php?type=users&supprime=<?php echo $m['id'] ?>">Supprimer</a></p>
                <?php } ?>
            </td>
            <td><p align="center">Table Users</p></td>

        </tr>
        <tr>
            <td>
                <?php while ($c = $produits->fetch()) { ?>
                    <p><?php echo $c['id'] ?> : <?php echo $c['nom'] ?>
                        : <?php echo $c['description'] ?> (<?php echo number_format($c['prix'], 2, '.', '') . ' € ' ?>
                        )<?php if ($c['confirme'] == 0) { ?> - <a
                                href="admin.php?type=produits&confirme=<?php echo $c['id'] ?>">Approuver</a><?php } ?> -
                        <a
                                href="admin.php?type=produits&supprime=<?php echo $c['id'] ?>">Supprimer</a></p>
                <?php } ?>
            </td>
            <td><p align="center">Table Produits</p></td>
        </tr>
    </table>
<?php
    } else {
        echo '<div class="content">
		<div style="display:flex;justify-content:center;">
		<a style="color:red;font-size:25px;" href="login.php">
		VEUILLEZ VOUS CONNECTER</a>
		</div> </div> </div>
	';
    }

    require_once("include/footer.php");
?>