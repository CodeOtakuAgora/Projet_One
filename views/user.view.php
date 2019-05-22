<div class="content">
	<div style="display: flex;justify-content: center;">
		<a style="color:red;font-size:25px;padding-top: 50px;"
           href="deconnection.php">SE DECONNECTER</a>
	</div>


	<h2 style="font-weight: bold;" align="center">Vendre un Produit</h2>
	<div class="container">


		<form method="POST" enctype="multipart/form-data">
			<input name="nom" type="text" placeholder="nom du produit">
			<input name="description" type="text" placeholder="description du produit">
			<input name="prix" step="0.01" type="number" placeholder="prix du produit">
			<input name="logo" type="file" placeholder="logo du produit">
			<select name="category">
				<?php
				foreach (Bdd::getInstance()->conn->query('SELECT * FROM categories') as $row) {
					echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';;
				}
				?>
			</select>
			<select name="souscategory">
				<?php
				foreach (Bdd::getInstance()->conn->query('SELECT * FROM sous_categories') as $row) {
					echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';;
				}
				?>
			</select>
			<input name="bouton" type="submit" value="Valider">
		</form>
	</div>

	<?php require_once('include/footer.php'); ?>

</div>
