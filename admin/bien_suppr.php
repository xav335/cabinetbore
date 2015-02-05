<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
	$aujourdhui = date("Y-m-d H:i:s");                         

	$query  = "DELETE FROM bien ";
	$query .= " WHERE id_bien=". $_GET["id_bien"];
	//echo $query ."<br>";
	$rstemp = mysql_query($query);
	
	$query  = "DELETE FROM media_bien ";
	$query .= " WHERE id_bien=". $_GET["id_bien"];
	//echo $query ."<br>";
	$rstemp = mysql_query($query);
	
	
	header("Location: bien_liste.php");
?>
<? include_once("../include/_connexion_fin.php"); ?>