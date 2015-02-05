<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<? include_once("_fonctions.php")?>
<?	
	$maintenant = date("Y-m-d H\:i\:s\ ");
	$date_debut=mktime ("00","00","00",$_POST["mois_debut"],$_POST["jour_debut"],$_POST["an_debut"]);
	$date_debut=date("Y/m/d H:i:s", $date_debut);

	$query  = "INSERT INTO collecte (date_collecte, titre, tranche_horaire) VALUES (";
	$query .= "'  ". $date_debut ."' " ;
	$query .= ", '". $_POST["titre"] ."' " ;
	$query .= ", '". $_POST["tranche_horaire"] ."' " ;
	$query .= ")";
	//echo $query ."<br>";
	$rstemp = mysql_query($query);
	$id_collecte = mysql_insert_id();
	
	header("Location: collecte_modif.php?id_collecte=". $id_collecte);

?>
<? include_once("../include/_connexion_fin.php"); ?>