# PROJET ONE BTS SIO SLAM E4 : SITE DE VENTE HWEAR

## ***Développé par Hugo Fief / Bastian Peire / Arthur Boutonnet***

```
Arborescence du Projet avec à la racine la partie php des pages principales :
├── crud : crud pour l'admin
│   ├── images : images du crud
│   └── views : vue du crud
├── doc : documentation d'utilisation
├── include : pages php annexes
│   ├── class : toutes les class (model) du site 
├── ressources : toutes les images du site
│   └───vetements : tous les produits (vetements) du site
├── sql : point sql de la base de donée
└── views : partie visible du site (front)
```

```
Arborescence de la Base de donnée hwear :
├── admin : informations de l'administrateur
├── categorie : informations concernant les catégories des produits
├── commentaires : informations concernant les commentaires des produits  
├── panier : informations concernant la panier propre à l'utilisateur
├── panier_produit : informations concernant les produits présents dans le panier de l'utilisateur
├── produit : informations concernant tous les produits
├── sous_categories : informations concernant les sous catégories des produits
└── users : informations de l'utilisateur
```

---
## ! IMPORTANT CHOSES A SAVOIR : 
- Etre connecté à internet avant de lancer le projet pour les import externes
- Les mots de passe sont hashés (cryptés) en **md5** avant d'être envoyer dans la base de donnée pour sa simplicité 
- Le site est sécurisé et est protéger contre les injections sql et les pages sont bien protéger 
- Pour la barre de recherche vous devez renter : 
	* t-shirt / pull / pantalon => si vous voulez un catégorie de produit
	* jaune / rouge / blanc => si vous voulez une couleur précise
- Mettez l'intitulez complet du nom du produit pour une une recherche précise 
	* tels que pull jaune ou t-shirt rouge
	* si vous n'avez aucun résultat vérifiez simplement l'orthographe 
	* car elle doit être en accord avec soit le nom ou la description du produit
- identifiant connection base de donnée :
	* utilisateur : root / mot de passe :    
	* base de donnée : hwear / hôte : localhost
- information nescessaire pour la base de donnée
 	* Un panier doit avoir comme champ statut 1
	* Un produit doit avoir comme champ confirme 1
	* Un utilisateur doit avoir comme champ approuve 1

--- 
## Commencement  
- Pour commencer aller dans le dossier doc qui contient la documentation d'utilisation du projet
- Puis aller dans le dossier include puis class et modifier le fichier Db.php si besoin
- Et pour finir aller dans le dossier sql et importer la base de donnée 

## ! Infos Utilisateur déjà créer !
- Administrateur : username : admin / password : admin
- User lambda : email : test@gmail.com / password : test
- 2ème utilisateur : email : user@gmail.com / password : user

---

## Partie Git

- Commandes Gitlab Basique :
	
	* git clone https://gitlab.com/hwear/hwear.git : **récupère le projet git**
	* git status : **vérifie l'état des fichiers**
	* git add * : **ajoute des fichiers aux projet git**
	* git commit -m "Ajout des Dossiers" : **donne un nom à ta sauvegarde**
	* git log --oneline : **liste toutes les sauvegardes du projet git**
	* git push origin master : **envoie ton projet sur git** 
	* git pull origin master : **met à jour ton repo avec la dernière version du projet** 	
	
	---

- Commandes Gitlab Avancé :
	
	* git branch : **liste toutes les branches du projet git**
	* git checkout dev : **te positionne sur une branche spécifique (dev)**
	* git push origin dev : **envoie ton projet sur git mais dans la branche dev**
	* git checkout master : **te repositionne sur la branche principale master**
	* git merge dev : **valide le projet git de la branche dev**
	* git push origin master : **envoie le contenue branche dev à la branche master**