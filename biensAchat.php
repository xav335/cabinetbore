<?php include_once("include/_connexion.php"); ?>
<?php

$where = "AND ";
$where .= "type_transaction = 1";


$sql = "SELECT * ";
$sql .= " FROM bien ";
$sql .= "WHERE actif=1 ".$where;
$sql .= " ORDER BY prix ASC"; 

//echo $sql;

$result = mysql_query($sql);
$nb_enr = mysql_num_rows($result);
?>
<html>
<head>
<title>Biens en vente | Agence Immobilière à Bordeaux | Cabinet Boré |</title>
<meta name="Content-Language" content="fr">
<meta name="Description" content="Le cabinet boré spécialisé dans la location de maisons et d'appartements, vous donne tous les renseignements pour louer un biens immobilier">
<meta name="Keywords" content="immobilier bordeaux, annonces, agences immobilières, biens, maison, terrain, garage, appartement, location, vente, achat, locations, syndic, fnaim, propriétaire, bailleur, investisseur, locataire, gestion immobilière, immo bordeaux, recherche de biens immobiliers, achat maison, vente maison, achat appartement, vente appartement, syndic d'immeuble">
<meta name="publisher" content="iconeo.fr">
<meta name="author" content="iconeo.fr">
<meta name="Revisit-After" content="16 days">
<meta name="Robots" content="all">
<script type="text/javascript">
document.location.href="http://www.cabinetbore.com/#page=resultatRecherche";
</script>
</head>
<body>
<noscript>
<h1>Nos biens en vente</h1>
<h2>Retrouvez sur cette page les ventes de biens immobiliers disponibles</h2>

<? if (mysql_num_rows($result)>0){
	
	while($row=mysql_fetch_array($result)){ ?>

		<p>
		<b><? echo $row["titre"] ?></b>&nbsp;&nbsp;<? echo $row["reference"] ?><br>
		Description :<? echo $row["description"] ?><br>
		ville :<? echo $row["ville"] ?><br>
		codePostal :<? echo $row["codePostal"] ?><br>
		prix :<? echo $row["prix"] ?><br>
		nbPieces :<? echo $row["nbPieces"] ?><br>
		surface Habitable :<? echo $row["surfaceHabitable"] ?><br>
		honoraires :<? echo $row["honoraires"] ?><br>
		
		<? $sql = "SELECT * ";
				$sql .= " FROM media_bien ";
				$sql .= "WHERE id_bien = ". $row["id_bien"] ." ";
				$sql .= " ORDER BY type_media"; 
				$result2 = mysql_query($sql);
				$nb_enr2 = mysql_num_rows($result2);
				if (mysql_num_rows($result2)>0){
					while($row2=mysql_fetch_array($result2)){ ?>
						<img src="<? echo $row2["url_apercu"] ?>" border=0> 
						<br><br>
<?   				}
				}
	}?>
	</p>
	<?
}
?>

<br>
<a href="index.html" >Retour à l'accueil</a>
</noscript>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11864990-8");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
<?php include_once("include/_connexion_fin.php"); ?>