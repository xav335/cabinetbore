<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
$sql = "SELECT * ";
$sql .= " FROM  bien ";
$sql .= " WHERE bien.id_bien=". $_GET["id_bien"];
$result = mysql_query($sql);
$nb_enr = mysql_num_rows($result);
if ($nb_enr>0){
	while ($prod = mysql_fetch_array($result)) {
		$id_bien = $prod["id_bien"];
		$reference =  $prod["reference"];
		$titre =  $prod["titre"];
		$description =  $prod["description"];
		$ville =  $prod["ville"];
		$adresse =  $prod["adresse"];
		$codePostal =  $prod["code_postal"];
		$nbPieces =  $prod["nb_pieces"];
		$proximite =  $prod["proximite"];
		$surfaceHabitable =  $prod["surface_habitable"];
		$surfaceTerrain =  $prod["surface_terrain"];
		$prix =  $prod["prix"];
		$honoraires =  $prod["honoraires"];
		$typeBien =  $prod["type_bien"];
		$typeTransaction =  $prod["type_transaction"];
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>cts</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../include/styles_admin.css" rel="stylesheet" type="text/css">
<script Language="JavaScript">
function Form1_Validator(theForm){
	
	 if (theForm.titre.value == ""){
	    	alert("Veuillez saisir un secteur.");
		    theForm.titre.focus();
		    return (false);
		 }  
		
	 if (theForm.description.value == ""){
   	alert("Veuillez saisir une description.");
	    theForm.description.focus();
	    return (false);
	 }  
	  
	 if (theForm.surfaceHabitable.value != ""){
		 if(!est_entier(theForm.surfaceHabitable.value)){
	    	alert("Veuillez saisir une surface habitable numérique.");
		    theForm.surfaceHabitable.focus();
		    return (false);
		 }
	 }  
	 
	 if (theForm.surfaceTerrain.value != ""){
		 if(!est_entier(theForm.surfaceTerrain.value)){
	    	alert("Veuillez saisir une surface de terrain numérique.");
		    theForm.surfaceTerrain.focus();
		    return (false);
		 }
	 }  
	 
	 if (theForm.prix.value != ""){
		 if(!est_entier(theForm.prix.value)){
	    	alert("Veuillez saisir un prix numérique.");
		    theForm.prix.focus();
		    return (false);
		 }
	 }
	 
	 if (theForm.honoraires.value != ""){
		 if(!est_entier(theForm.honoraires.value)){
	    	alert("Veuillez saisir des honoraires numérique.");
		    theForm.honoraires.focus();
		    return (false);
		 }
	 }  
	 
	 return true;
	
}


function est_reel(le_nombre){	
	var nbex = le_nombre
	
	if (!isFinite(nbex)){
		x = nbex.indexOf(',')
	
		entier = nbex.slice(0,x)
		decimale = nbex.slice(x+1,100)
		nombre = entier + '.' + decimale
	}else{
		nombre = nbex;
	}
	
	if (isFinite(nombre)){
		 estreel = true
	}else{
		estreel = false
	}
	return (estreel);
}

function est_entier(le_nombre){
	var checkOK = "0123456789-";
	var checkStr = le_nombre;
	var allValid = true;
	var decPoints = 0;
	var allNum = "";
	for (i = 0;  i < checkStr.length;  i++)
	{
	    ch = checkStr.charAt(i);
	    for (j = 0;  j < checkOK.length;  j++)
	      if (ch == checkOK.charAt(j))
	        break;
	    if (j == checkOK.length)
	    {
	      allValid = false;
	      break;
	    }
	    allNum += ch;
	}
	if (!allValid){
		return (false);
	}else{
		return (true);
	}
}	  

function valide_inscription(){
	//if ((document.formulaire.nom.value!='') && (document.formulaire.prenom.value!='')) {
		wLoader('valide_adhesion.php?email=' + escape(document.formulaire.email.value))		
	//}
	return false
}

var globWin;            
function wLoader(_URL)  
{	
	var _windowTitle="_blank";
	var _windowSettings="top=80,left=150,screenX=0,screenY=0,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400";

	globWin = window.open(_URL,_windowTitle,_windowSettings);
}


function est_mail(chaine){
	if (chaine.search(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9]+)*$/) == -1){
		return false;
	}else{	
		return true;
	}
}
</script>
</head>
<body id="fond_gris" leftmargin="0" topmargin="0" bgproperties="fixed" id="fond_rose" border="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="middle">
		<table width="84%" border="0" cellpadding="10" cellspacing="0" align="center">
        <form action="bien_modif_2.php" method="post" name="formulaire"  onsubmit="return Form1_Validator(this)" enctype="application/x-www-form-urlencoded">
        	<input type="hidden" name="id_bien" value="<? echo $id_bien?>">
        	<tr>
            		<td align="center" id="texte3">Modification de bien</td>
        	</tr>
          	<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Type de bien :&nbsp;&nbsp;
	                  		<select name="typeBien" >
	                  			<option value="1" <?if($typeBien==1) echo "SELECTED"?>>Maison</option>
	                  			<option value="2" <?if($typeBien==2) echo "SELECTED"?>>Appartement</option>
	                  			<option value="3" <?if($typeBien==3) echo "SELECTED"?>>Terrain</option>
	                  			<option value="4" <?if($typeBien==4) echo "SELECTED"?>>Garage</option>
	                  			<option value="5" <?if($typeBien==5) echo "SELECTED"?>>Locaux commerciaux</option>
	                  			<option value="6" <?if($typeBien==6) echo "SELECTED"?>>Immeuble</option>
	                  			<option value="7" <?if($typeBien==7) echo "SELECTED"?>>Bureaux</option>
	                  			<option value="8" <?if($typeBien==8) echo "SELECTED"?>>Locaux pro.</option>
	                  			<option value="9" <?if($typeBien==9) echo "SELECTED"?>>Propriété</option>
	                  		</select>
						</td>
	                  	<td  height="30" id="texte2b">Type de Transaction:<br>
							<input type="radio" name="typeTransaction" value="1" <?if($typeTransaction==1) echo "CHECKED"?>> Vente<br>
	                  		<input type="radio" name="typeTransaction" value="2" <?if($typeTransaction==2) echo "CHECKED"?>> Location<br>
						</td>
	                </tr>
	              	</table>
				</td>
          	</tr>
          	
			<tr> 
                  <td> <table cellspacing="0" cellpadding="0" border="0">
                      <tr> 
                        <td id="texte2b">Description :<br> 
                          <textarea cols="35" rows="4" name="description" wrap="soft"><? echo htmlspecialchars($description)?></textarea> 
                        </td>
                        <td id="texte2b">Proximité :<br> 
                          <textarea cols="35" rows="4" name="proximite" wrap="soft"><? echo htmlspecialchars($proximite)?></textarea> 
                        </td>
                      </tr>
                    </table></td>
			</tr>
			
			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Ville :&nbsp;&nbsp;
	                  		<input size="40"  name="ville" type="text" value="<? echo $ville?>"></td>
	                  	<td  height="30" id="texte2b">Code postal :&nbsp;&nbsp;
	                  		<input size="15"  name="codePostal" type="text" value="<? echo $codePostal?>"></td>
	                </tr>
	              	</table>
				</td>
          	</tr>

			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Adresse :&nbsp;&nbsp;
	                  		<input size="60"  name="adresse" type="text" value="<? echo $adresse?>"></td>
	                  	<td  height="30" id="texte2b">Secteur :&nbsp;&nbsp;
	                  		<input size="30"  name="titre" type="text" value="<? echo htmlspecialchars($titre)?>"></td>
	                </tr>
	              	</table>
				</td>
          	</tr>

			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Nombre de pièces :&nbsp;&nbsp;
	                  		<select name="nbPieces" >
	                  			<option <?if($nbPieces==1) echo "SELECTED"?>>1</option>
	                  			<option <?if($nbPieces==2) echo "SELECTED"?>>2</option>
	                  			<option <?if($nbPieces==3) echo "SELECTED"?>>3</option>
	                  			<option <?if($nbPieces==4) echo "SELECTED"?>>4</option>
	                  			<option <?if($nbPieces==5) echo "SELECTED"?>>5</option>
	                  			<option value=6 <?if($nbPieces==6) echo "SELECTED"?>>6+</option>
	                  		</select>
	                  	<td  height="30" id="texte2b">Surface habitable :&nbsp;&nbsp;
	                  		<input size="15"  name="surfaceHabitable" type="text" value="<? echo $surfaceHabitable?>">m²</td>
	                  	<td  height="30" id="texte2b">Surface du terrain :&nbsp;&nbsp;
	                  		<input size="15"  name="surfaceTerrain" type="text" value="<? echo $surfaceTerrain?>">m²</td>
	                </tr>
	              	</table>
				</td>
          	</tr>

			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Prix :&nbsp;&nbsp;
	                  		<input size="15"  name="prix" type="text" value="<? echo $prix?>">€</td>
	                  	<td  height="30" id="texte2b">Honoraires :&nbsp;&nbsp;
	                  		<input size="15"  name="honoraires" type="text" value="<? echo $honoraires?>">€</td>
	                </tr>
	              	</table>
				</td>
          	</tr>

         	<tr> 
        		<td align="center" id="texte3_blanc"><br> <img src="../images/pixel_rouge.jpg" width="110%" height="1"></td>
         	</tr>
 
          	<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr> 
                  		<td align="center"> <input type="button" value="retour à la liste" onclick="javascript:document.location.href='bien_liste.php'"> </td>
                  		<td align="center"> <input type="submit" name="vvv" value="Valider"> 
                  		</td>
                	</tr>
              		</table>
				</td>
          </tr>
        </form>
      </table>
	</td>
  </tr>
</table>
</body>
</html>
<? include_once("../include/_connexion_fin.php"); ?>