<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
	
	$query  = "DELETE FROM media_bien ";
	$query .= " WHERE id_media_bien=". $_GET["id_media_bien"];
	$rstemp = mysql_query($query);
	
	header("Location: media_liste_bien.php?id_bien=". $_GET["id_bien"]);
?>
<? include_once("../include/_connexion_fin.php"); ?>