<?php

    $titleAdminConnect = "Connection Admin";
    require_once('include/require.php');


    if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
        echo '
	<br/><br/><br/><br/>
	<div class="contenupage">
			<div class="container">
				<div class="row formulaireconnect">
					<table width="100%">
						<thead>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="connexion">
										<h1>Administraion</h1>
										<form  action="" id="myform" method="POST" enctype="multipart/form-data">
											<p>Login:</p>
											<input name="login" type="text" value="" size="30"/><br><br>
											<p>Password:</p>
											<input name="password" type="password" value="" size="30"/><br><br>
											<input name="bouton" type="submit" id="seconnecter" value="Connexion" onclick="document.forms[\'myform\'].submit();"/><br/><br/>
										</form>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<br>				
				</div>
			</div>		
		</div>';
    }
    require_once('include/footer.php');
?>




<?php
    if (!isset($_REQUEST['login'])) {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n L'email n'est pas au bon format";
        } else {
            $erreur = "L'email n'est pas au bon format";
        }

    }

    if (!isset($_REQUEST['password']) || trim($_REQUEST['password']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le password est manquant";
        } else {
            $erreur = "Le password est manquant";
        }

    }

    if (!isset($erreur)) {
        $result = Bdd::getInstance()->conn->query('SELECT * FROM `admin` WHERE `login` LIKE "' . $_REQUEST['login'] . '" AND `password` LIKE "' . md5($_REQUEST['password']) . '"');
        if ($result != "") {
            while ($row = $result->fetch()) {
                $_SESSION['login'] = $row['login'];
            }

            if (isset($_SESSION['login'])) {
                ?>

                <script type="text/javascript">
                    swal({
                        title: "Succès!",
                        text: "Votre compte à bien été créé",
                        type: "success",
                    }, function () {
                        window.location.href = "index.php";
                    });
                </script>
                <?php
            } else {
                $erreur = " \\n Couple login/mot de passe erroné";

            }
        }

    }
    if (isset($erreur) && isset($_POST['bouton'])) {

        echo '
					<script type="text/javascript">
						sweetAlert("Echec","' . $erreur . '","error");
					</script>';
    }

?>
