<?php include_once("include/_connexion.php"); ?>
<?php

//ville=33000&type_transaction=2&type_bien=2&
//nb_pieces=3&surface_min=70&budget_min=800&budget_max=1200

$and = false;
if(isset($_GET["ville"]) && $_GET["ville"] != ""){
	$where .= "AND ";
	$where .= "(ville LIKE '%".$_GET["ville"]."%' OR code_postal LIKE '%".$_GET["ville"]."%') ";
	$and = true;
}
if(isset($_GET["type_transaction"]) && $_GET["type_transaction"] != ""){
	$where .= "AND ";
	$where .= "type_transaction = '".$_GET["type_transaction"]."' ";
	$and = true;
}
if(isset($_GET["type_bien"]) && $_GET["type_bien"] != ""){
	$where .= "AND ";
	$where .= "type_bien = '".$_GET["type_bien"]."' ";
	$and = true;
}
if(isset($_GET["nb_pieces"]) && $_GET["nb_pieces"] != ""){
	$where .= "AND ";
	$where .= "nb_pieces = '".$_GET["nb_pieces"]."' ";
	$and = true;
}
if(isset($_GET["surface_min"]) && $_GET["surface_min"] != ""){
	$where .= "AND ";
	$where .= "surface_terrain = '".$_GET["surface_min"]."' ";
	$and = true;
}
if(isset($_GET["budget_min"]) && $_GET["budget_min"] != ""){
	$where .= "AND ";
	$where .= "prix >= '".$_GET["budget_min"]."' ";
	$and = true;
}
if(isset($_GET["budget_max"]) && $_GET["budget_max"] != ""){
	$where .= "AND ";
	$where .= "prix <= '".$_GET["budget_max"]."' ";
}

$sql = "SELECT * ";
$sql .= " FROM bien ";
$sql .= "WHERE actif=1 ".$where;
$sql .= " ORDER BY prix ASC"; 

//echo $sql;

$result = mysql_query($sql);
$nb_enr = mysql_num_rows($result);

$dom = new DOMDocument('1.0', 'iso-8859-1');

$actualite = $dom->createElement('resultats');
if (mysql_num_rows($result)>0){
	
	while($row=mysql_fetch_array($result)){
	
    	$item = $dom->createElement('bien');
    		$item->setAttribute("reference", utf8_encode($row["reference"]));
    		$item->setAttribute("titre", utf8_encode($row["titre"]));
    		$item->setAttribute("ville", utf8_encode($row["ville"]));
    		$item->setAttribute("description", utf8_encode($row["description"]));
    		$item->setAttribute("codePostal", utf8_encode($row["code_postal"]));
    		$item->setAttribute("nbPieces", utf8_encode($row["nb_pieces"]));
    		$item->setAttribute("proximite", utf8_encode($row["proximite"]));
    		$item->setAttribute("surfaceHabitable", utf8_encode($row["surface_habitable"]));
    		$item->setAttribute("surfaceTerrain", utf8_encode($row["surface_terrain"]));
    		$item->setAttribute("prix", utf8_encode($row["prix"]));
    		$item->setAttribute("honoraires", utf8_encode($row["honoraires"]));
    		$item->setAttribute("typeBien", utf8_encode($row["type_bien"]));
        	$item->setAttribute("typeTransaction", utf8_encode($row["type_transaction"]));
    		
    		
        	$sql = "SELECT * ";
				$sql .= " FROM media_bien ";
				$sql .= "WHERE id_bien = ". $row["id_bien"] ." ";
				$sql .= " ORDER BY type_media"; 
				$result2 = mysql_query($sql);
				$nb_enr2 = mysql_num_rows($result2);
				if (mysql_num_rows($result2)>0){
					while($row2=mysql_fetch_array($result2)){
	        			$media = $dom->createElement('image');
	        			
	        			$media->setAttribute("urlApercu", utf8_encode($row2["url_apercu"]));
	        			$media->setAttribute("urlImage", utf8_encode($row2["url_media"]));
	        			
		        		$item->appendChild($media);	
					}
				}	
		$actualite->appendChild($item);

	}
}
$dom->appendChild($actualite);
$dom->normalizeDocument();
echo $dom->saveXML();
?>
<?php include_once("include/_connexion_fin.php"); ?>