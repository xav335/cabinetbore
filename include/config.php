<?
	// Passage rapide du site en TEST au site en PROD
	$en_test = 1;
	
	// Site en DEV
	if ($en_test == 3) {
		
		// Chemins g�n�raux pour acc�der aux diff�rentes pages
		$chemin = "http://127.0.0.1/";
	}
	
	// Site en TEST
	else if ($en_test == 2) {
		
		// Chemins g�n�raux pour acc�der aux diff�rentes pages
		$chemin = "collants.gonzalezalvarez.org/";
	}
	
	// Site en PROD
	else {
		// Chemins g�n�raux pour acc�der aux diff�rentes pages
		$chemin = "http://www.cabinetbore.com/";
	}
?>