<html>
<head>
<title>Connexion</title>
<?php
$adresse = $_SERVER['HTTP_REFERER'];
echo "<meta http-equiv=\"refresh\" content=\"3; URL=$adresse\">";

?>
</head>
<body>
<?php
	session_start();
	$user = $_POST['user'];
	$passwd = $_POST['password'];
	$bdd = mysqli_connect("localhost", "root", "MySQL", "projet");
	$result = mysqli_query($bdd, "SELECT * FROM utilisateur WHERE login='$user' AND mdp=PASSWORD('$passwd')");
	$enr = mysqli_num_rows($result);
	if($enr == 0) {
		if(!$bdd){
			echo("Echec de connection a la base de donn&eacute;e");
		}
			session_unset(); 
			mysqli_close($bdd);
			echo("Mot de passe ou utilisateur incorrect<BR>");
		}
	else {
		$_SESSION['actif']= TRUE;
		$result = mysqli_query($bdd, "SELECT * FROM utilisateur WHERE login='$user'");
		$donnees = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $donnees['login'];
		$_SESSION['admin'] = $donnees['privilege'];
		echo "Connexion r&eacute;ussie<br>";
		$ip = $_SERVER['REMOTE_ADDR'];
		$user = $donnees['login'];
		$date = date("Y")."/".date("m")."/".date("j");
		$heure = date("H").":".date("i").":".date("s");
		$result = mysqli_query($bdd, "INSERT INTO connexion SET date='$date', heure='$heure', ip='$ip', login='$user'");
		}
	
	$adresse = $_SERVER['HTTP_REFERER'];
	echo "<center><a href=\"$adresse\">Cliquez ici si votre navigateur ne vous redirige pas automatiquement</a></center>";
?>
</body>
</html>