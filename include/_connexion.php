<?
// Param�tres
$host = "localhost"; 
$user = "bore";
$pass = "bore33";
$bdd = "cabinet_bore"; 
// connexion
$mysql_link=@mysql_connect($host,$user,$pass)
   or die("1 : Impossible de se connecter � la base de donn�es");
   @mysql_select_db($bdd)
   or die("2 : Impossible de se connecter � la base de donn�e");
?>