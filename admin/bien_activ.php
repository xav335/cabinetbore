<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
	$aujourdhui = date("Y-m-d H:i:s");                         

	$query  = "UPDATE bien ";
	$query .= "SET actif=". $_GET["actif"];
	$query .= " WHERE id_bien=". $_GET["id_bien"];
	//echo $query ."<br>";
	$rstemp = mysql_query($query);
	
	header("Location: bien_liste.php");
?>
<? include_once("../include/_connexion_fin.php"); ?>