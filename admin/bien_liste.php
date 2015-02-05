<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<? include_once("_fonctions.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>cts</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../include/styles_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//-->
</script>
<script Language="JavaScript">

</script>
</head>
<body id="fond_blanc" leftmargin="0" topmargin="0" bgproperties="fixed" id="fond_rose" onLoad="MM_preloadImages('images/modifier_over.gif','images/supprimer_over.gif','images/chercher_over.gif')" border="0">

<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
  	<?
  		$filtre=$_POST["filtre"];
  		if(isset($filtre)){

	  		$_SESSION["vente"]=0;
			$_SESSION["location"]=0;
			$_SESSION["en_ligne"]=0;
			$_SESSION["desactive"]=0;
	  		
	  		foreach ($filtre as $choix)
			{
				if($choix == "check_vente")$_SESSION["vente"]=1;
				if($choix == "check_loc")$_SESSION["location"]=1;
				if($choix == "check_ligne")$_SESSION["en_ligne"]=1;
				if($choix == "check_desact")$_SESSION["desactive"]=1;
			}
  		}
		
  		if (!isset($_GET["champ"])) $_GET["champ"] = "id_bien";
		if (!isset($_GET["ordre"])) $_GET["ordre"] = "DESC";
		
		
		$where = "WHERE (type_transaction = 50 ";
        if($_SESSION["vente"]){
	        $where .= " OR type_transaction = 1 ";
        }
        if($_SESSION["location"]) {
        	$where .= " OR type_transaction = 2";
        }
        
        $where .= ") AND (actif = 50 ";
        
        if($_SESSION["en_ligne"]){
        	$where .= " OR actif = 1 ";
        }
        if($_SESSION["desactive"]) {
        	$where .= " OR actif = 0 ";
        }
        
        $where .= ")";
        
		
		
		
		$sql = "SELECT bien.*, count(media_bien.id_media_bien) as nb_images";
        $sql .= " FROM bien LEFT JOIN media_bien ON bien.id_bien=media_bien.id_bien ";
        $sql .= $where;
        $sql .= " group by bien.id_bien ";
		$sql .= " ORDER BY ". $_GET["champ"]." ".$_GET["ordre"]; 
		
		echo $sql;
		
		$result = mysql_query($sql);
		$nb_enr = mysql_num_rows($result);
	?>

    <form action="bien_liste.php?champ=<?echo $_GET["champ"];?>&ordre=<?echo $_GET["ordre"];?>" method="post" name="formulaire_filtre" onSubmit="filtrer()" enctype="multipart/form-data">
    	Filtrer les annonces : vente <INPUT TYPE=CHECKBOX NAME="filtre[]" VALUE="check_vente" <?if($_SESSION["vente"])echo "checked"?>>
    	location <INPUT TYPE=CHECKBOX NAME="filtre[]" VALUE="check_loc" <?if($_SESSION["location"])echo "checked"?>>
    	&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;en ligne <INPUT TYPE=CHECKBOX NAME="filtre[]" VALUE="check_ligne" <?if($_SESSION["en_ligne"])echo "checked"?>>
    	desactiv� <INPUT TYPE=CHECKBOX NAME="filtre[]" VALUE="check_desact" <?if($_SESSION["desactive"])echo "checked"?>>
    	<input type="submit" value="Filtrer">
    </form>

	<? if (mysql_num_rows($result)>0) {?>
    	<td valign="top">
    	
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
	        <tr align="center" >
				<td class="affichageT" align="left">&nbsp;</td>
	          	<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=type_transaction&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">type trans.</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=type_bien&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">type bien</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=ville&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">ville</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=code_postal&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">code postal</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=nb_pieces&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">nb pieces</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=surface_habitable&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">surface habitable</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=surface_terrain&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">surface terrain</a></td>
				<td class="affichageT" align="left"><a class="affichageT" href="bien_liste.php?champ=prix&ordre=<?if($_GET["ordre"]=="ASC"){echo "DESC";}else{echo "ASC";}?>">prix</a></td>
			  	<td class="affichageT" align="left">&nbsp;</td>
	        </tr>
			<? while($row=mysql_fetch_array($result)){ ?>
				<?								
					if ($cc % 2){
						$class_ch="affichage2";
					}else{
						$class_ch="affichage";
					}
				?>		
			<tr align="center""> 
			 	<td class="<? echo $class_ch?>" align="left"><a href="bien_modif.php?id_bien=<? echo $row["id_bien"]?>"><img src="modifier_off.gif" alt="" width="13" height="13" border="0"></a></td>
	          	<td class="<? echo $class_ch?>" align="left"><b>
	          		<?
	          		switch ($row["type_transaction"]) {
					case 1:
					    echo "vente";
					    break;
					case 2:
					    echo "loc";
					    break;
					}
	          		
	          		
	          		?>
			   	</b></td>
		   		<td class="<? echo $class_ch?>" align="left"><b>
			   		<?
	          		switch ($row["type_bien"]) {
					case 1:
					    echo "maison";
					    break;
					case 2:
					    echo "appart.";
					    break;
					case 3:
					    echo "terrain";
					    break;
					case 4:
					    echo "garage";
					    break;
          			case 5:
					    echo "loc. com.";
					    break;
					case 6:
					    echo "imm.";
					    break;
          			case 7:
					    echo "bur.";
					    break;
          			case 8:
					    echo "loc. pro.";
					    break;
				    case 9:
					    echo "prop.";
					    break;
	          		}
	          		?>
			   	</b></td>
			   	<td class="<? echo $class_ch?>" align="left"><b><? echo htmlspecialchars($row["ville"], ENT_QUOTES)?></b></td>
			   	<td class="<? echo $class_ch?>" align="left"><b><? echo htmlspecialchars($row["code_postal"], ENT_QUOTES)?></b></td>
			   	<td class="<? echo $class_ch?>" align="left"><b><? echo (($row["nb_pieces"]==6)?"6+":$row["nb_pieces"])?></b></td>
			   	<td class="<? echo $class_ch?>" align="left"><b><? echo htmlspecialchars((($row["surface_habitable"] != "0")?$row["surface_habitable"]." m�":"N/A"), ENT_QUOTES)?></b></td>
			   	<td class="<? echo $class_ch?>" align="left"><b><? echo htmlspecialchars((($row["surface_terrain"] != "0")?$row["surface_terrain"]." m�":"N/A"), ENT_QUOTES)?></b></td>
			   	<td class="<? echo $class_ch?>" align="left"><b><? echo htmlspecialchars((($row["prix"] != "0")?$row["prix"]."�":"N/A"), ENT_QUOTES)?></b></td>
			  	<td class="<? echo $class_ch?>" align="left"><a href="media_liste_bien.php?id_bien=<? echo $row["id_bien"]?>"><img src="<? echo ($row["nb_images"] == 0)?"tab_galerie_inactive.png":"tab_galerie_active.png" ?>" alt="" width="13" height="13" border="0"></a></td>
			  	<td class="<? echo $class_ch?>" align="left"><a href="bien_activ.php?id_bien=<? echo $row["id_bien"]?>&actif=<? echo ($row["actif"] == 0)?"1":"0"?>" onclick="return confirm('�tes-vous s�r de vouloir <? echo ($row["actif"] == 0)?"activer":"desactiver" ?> le bien <? echo $row["id_bien"] ?> ?')"><img src="<? echo ($row["actif"] == 0)?"actif_off.gif":"actif_on.gif" ?>" alt="" width="13" height="13" border="0"></a></td>
			  	<td class="<? echo $class_ch?>" align="left"><a href="bien_suppr.php?id_bien=<? echo $row["id_bien"]?>" onclick="return confirm('�tes-vous s�r de vouloir supprimer le bien <? echo $row["id_bien"] ?> ?')"><img src="supprimer_off.gif" alt="" width="13" height="13" border="0"></a></td>
	        </tr>
				<? $cc++ ?>	
			<? }?>
	      	</table>
	  </td>
	  <? } else {?>
	  	<td align="center">Pas de bien dans la base</td>
	  <? }?>
  </tr>
</table>
</body>
</html>
<?php include_once("../include/_connexion_fin.php"); ?>