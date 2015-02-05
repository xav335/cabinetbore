<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
	$aujourdhui = date("Y-m-d H:i:s");                         

	$query  = "DELETE FROM collecte ";
	$query .= " WHERE id_collecte=". $_GET["id_collecte"];
	//echo $query ."<br>";
	$rstemp = mysql_query($query);
	
	
	
	header("Location: collecte_liste.php");
?>
<? include_once("../include/_connexion_fin.php"); ?>