<? include_once("../include/_session.php");?>
<? include_once("../include/_securite.php");?>
<? include_once("../include/_connexion.php"); ?>
<?
	$date_debut = date("Y-m-d H\:i\:s\ ");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>cts</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../include/styles_admin.css" rel="stylesheet" type="text/css">
<script Language="JavaScript">
/* 
reference=""
titre=""
description=""
ville=""
codePostal=""
nbPieces=""
proximite=""
surfaceHabitable=""
surfaceTerrain=""
prix=""
honoraires=""
*/

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
        <form action="bien_ajout_2.php" method="post" name="formulaire"  onsubmit="return Form1_Validator(this)" enctype="application/x-www-form-urlencoded">
        	<input type="hidden" name="id_bien" value="<? echo $id_bien?>">
        	<tr>
            		<td align="center" id="texte3">Ajout Bien</td>
        	</tr>
          	<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Type de bien :&nbsp;&nbsp;
	                  		<select name="typeBien" >
	                  			<option value="1" SELECTED>Maison</option>
	                  			<option value="2">Appartement</option>
	                  			<option value="3">Terrain</option>
	                  			<option value="4">Garage</option>
	                  			<option value="5">Locaux commerciaux</option>
	                  			<option value="6">Immeuble</option>
	                  			<option value="7">Bureaux</option>
	                  			<option value="8">Locaux pro.</option>
	                  			<option value="9">Propriété</option>
	                  		</select>
						</td>
	                  	<td  height="30" id="texte2b">Type de Transaction:<br>
							<input type="radio" name="typeTransaction" value="1" checked> Vente<br>
	                  		<input type="radio" name="typeTransaction" value="2"> Location<br>
						</td>
	                </tr>
	              	</table>
				</td>
          	</tr>
          	
			<tr> 
                  <td> <table cellspacing="0" cellpadding="0" border="0">
                      <tr> 
                        <td id="texte2b">Description :<br> 
                          <textarea cols="35" rows="4" name="description" wrap="soft"></textarea> 
                        </td>
                        <td id="texte2b">Proximit� :<br> 
                          <textarea cols="35" rows="4" name="proximite" wrap="soft"></textarea> 
                        </td>
                      </tr>
                    </table></td>
			</tr>
			
			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Ville :&nbsp;&nbsp;
	                  		<input size="40"  name="ville" type="text" value=""></td>
	                  	<td  height="30" id="texte2b">Code postal :&nbsp;&nbsp;
	                  		<input size="15"  name="codePostal" type="text" value=""></td>
	                </tr>
	              	</table>
				</td>
          	</tr>

			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Adresse :&nbsp;&nbsp;
	                  		<input size="60"  name="adresse" type="text"></td>
	                  	<td  height="30" id="texte2b">Secteur :&nbsp;&nbsp;
	                  		<input size="30"  name="titre" type="text" value=""></td>
						</td>
	                </tr>
	                </tr>
	              	</table>
				</td>
          	</tr>

			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Nombre de pi�ces :&nbsp;&nbsp;
	                  		<select name="nbPieces" >
	                  			<option>1</option>
	                  			<option>2</option>
	                  			<option>3</option>
	                  			<option>4</option>
	                  			<option>5</option>
	                  			<option value=6>6+</option>
	                  		</select>
	                  	<td  height="30" id="texte2b">Surface habitable :&nbsp;&nbsp;
	                  		<input size="15"  name="surfaceHabitable" type="text">m�</td>
	                  	<td  height="30" id="texte2b">Surface du terrain :&nbsp;&nbsp;
	                  		<input size="15"  name="surfaceTerrain" type="text" value="">m�</td>
	                </tr>
	              	</table>
				</td>
          	</tr>

			<tr> 
            	<td> 
					<table width="100%" border="0" cellpadding="2" cellspacing="0">
	                <tr> 
	                  	<td  height="30" id="texte2b">Prix :&nbsp;&nbsp;
	                  		<input size="15"  name="prix" type="text">�</td>
	                  	<td  height="30" id="texte2b">Honoraires :&nbsp;&nbsp;
	                  		<input size="15"  name="honoraires" type="text" value="">�</td>
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
                  		<td align="center"> <input type="button" value="retour � la liste" onclick="javascript:document.location.href='bien_liste.php'"> </td>
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