<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<? include_once("_fonctions.php")?>
<?	

	$maintenant = date("Y-m-d H\:i\:s\ ");
	$date_debut=mktime ("00","00","00",$_POST["mois_debut"],$_POST["jour_debut"],$_POST["an_debut"]);
	$date_debut=date("Y/m/d H:i:s", $date_debut);
	
	$query  = "UPDATE collecte ";
	$query .= "Set date_collecte='". $date_debut ."' " ;
	$query .= ", titre='". $_POST["titre"] ."' " ;
	$query .= ", tranche_horaire='". $_POST["tranche_horaire"] ."' " ;
	$query .= " WHERE id_collecte=". $_POST["id_collecte"];
	//echo $query ."<br>";
	$rstemp = mysql_query($query);

	header("Location: collecte_modif.php?id_collecte=". $_POST["id_collecte"]);

?>
<? include_once("../include/_connexion_fin.php"); ?>