<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<? include_once("_fonctions.php")?>
<?	
	$query  = "INSERT INTO bien (date_bien, reference, titre, description, ville, code_postal, ";
	$query .= "nb_pieces, proximite, surface_habitable, surface_terrain, prix, honoraires, ";
	$query .= "type_bien, type_transaction) VALUES (";
	$query .= "NOW()" ;
	$query .= ", '". $_POST["reference"] ."' " ;
	$query .= ", '". $_POST["titre"] ."' " ;
	$query .= ", '". $_POST["description"] ."' " ;
	$query .= ", '". $_POST["ville"] ."' " ;
	$query .= ", '". $_POST["codePostal"] ."' " ;
	$query .= ", '". $_POST["nbPieces"] ."' " ;
	$query .= ", '". $_POST["proximite"] ."' " ;
	$query .= ", '". $_POST["surfaceHabitable"] ."' " ;
	$query .= ", '". $_POST["surfaceTerrain"] ."' " ;
	$query .= ", '". $_POST["prix"] ."' " ;
	$query .= ", '". $_POST["honoraires"] ."' " ;
	$query .= ", '". $_POST["typeBien"] ."' " ;
	$query .= ", '". $_POST["typeTransaction"] ."' " ;
	$query .= ")";
	//echo $query ."<br>";
	$rstemp = mysql_query($query);
	
	$id_bien = mysql_insert_id();

	header("Location: bien_liste.php");

?>
<? include_once("../include/_connexion_fin.php"); ?>