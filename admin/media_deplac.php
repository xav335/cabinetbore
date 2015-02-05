<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
	
	//la ligne à déplacer
	$update_id1 = 0;
	$update_ordre1 = 0;
	//La ligne dont elle prend la place
	$update_id2 = 0;
	$update_ordre2 = 0;
	
	$realiser_deplacement = true;
	
	$update_id1 = $_GET["id_media_bien"];
	$update_ordre1 = $_GET["ordre"];
	
	//On récupère la ligne qui a la plus grand ordre inferieur à la ligne à déplacer
	//(donc la ligne qui précède)
	if($_GET["sens"] == 'haut'){
		$query  = "SELECT *";
		$query .= " FROM media_bien";
		$query .= " WHERE id_bien =".$_GET["id_bien"];
		$query .= " AND ordre <".$_GET["ordre"];
		$query .= " ORDER BY ordre DESC";
		$query .= " LIMIT 1 ";
	} else {
		$query  = "SELECT *";
		$query .= " FROM media_bien";
		$query .= " WHERE id_bien =".$_GET["id_bien"];
		$query .= " AND ordre >".$_GET["ordre"];
		$query .= " ORDER BY ordre ASC";
		$query .= " LIMIT 1 ";
	}
	
	//echo $query."<br>";
	$result = mysql_query($query);
	$nb_enr = mysql_num_rows($result);
	if (mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$update_id2 = $row["id_media_bien"];
			$update_ordre2 = $row["ordre"];
			
			//echo "ligne à deplacer : ".$update_id1."/".$update_ordre1."<br>";
			//echo "ligne dont elle prend la place : ".$update_id2."/".$update_ordre2."<br>";
		}
	} else {
		//Si le media est deja en premiere position, il ne bouge pas
		$realiser_deplacement = false;
	}
	
	if($realiser_deplacement){
		$query  = "UPDATE media_bien ";
		$query .= "SET ordre=".$update_ordre1;
		$query .= " WHERE id_media_bien=".$update_id2;
	
		//echo $query."<br>";
		$rstemp = mysql_query($query);

		$query  = "UPDATE media_bien ";
		$query .= "SET ordre=".$update_ordre2;
		$query .= " WHERE id_media_bien=".$update_id1;
	
		//echo $query."<br>";
		$rstemp = mysql_query($query);
	}

	header("Location: media_liste_bien.php?id_bien=". $_GET["id_bien"]);
?>
<? include_once("../include/_connexion_fin.php"); ?>