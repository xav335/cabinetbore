<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<? include_once("_fonctions.php")?>
<?	

	$maintenant = date("Y-m-d H\:i\:s\ ");
	$date_debut=mktime ("00","00","00",$_POST["mois_debut"],$_POST["jour_debut"],$_POST["an_debut"]);
	$date_debut=date("Y/m/d H:i:s", $date_debut);
	
	$query  = "UPDATE bien ";
	$query .= "Set date_bien='". $date_debut ."' " ;
	$query .= ", reference='". $_POST["reference"] ."' " ;
	$query .= ", titre='". $_POST["titre"] ."' " ;
	$query .= ", description='". $_POST["description"] ."' " ;
	$query .= ", ville='". $_POST["ville"] ."' " ;
	$query .= ", adresse='". $_POST["adresse"] ."' " ;
	$query .= ", code_postal='". $_POST["codePostal"] ."' " ;
	$query .= ", nb_pieces='". $_POST["nbPieces"] ."' " ;
	$query .= ", proximite='". $_POST["proximite"] ."' " ;
	$query .= ", surface_habitable='". $_POST["surfaceHabitable"] ."' " ;
	$query .= ", surface_terrain='". $_POST["surfaceTerrain"] ."' " ;
	$query .= ", prix='". $_POST["prix"] ."' " ;
	$query .= ", honoraires='". $_POST["honoraires"] ."' " ;
	$query .= ", type_bien='". $_POST["typeBien"] ."' " ;
	$query .= ", type_transaction='". $_POST["typeTransaction"] ."' " ;
	$query .= " WHERE id_bien=". $_POST["id_bien"];
	//echo $query ."<br>";
	$rstemp = mysql_query($query);

	
	header("Location: bien_liste.php");

?>
<? include_once("../include/_connexion_fin.php"); ?>