<html>
<head>
<title>Connexion</title>
<?php
$adresse = $_SERVER['HTTP_REFERER'];
echo "<meta http-equiv=\"refresh\" content=\"0; URL=$adresse\">";

?>
</head>
<body>
<center>
<?php
	session_start();
	$adresse = $_SERVER['HTTP_REFERER'];
	$user = $_SESSION['username'];
	$bdd = mysqli_connect("localhost", "root", "MySQL", "projet");
	if($bdd == FALSE)
		die("ERREUR -- Base de données inaccessible, contactez l'administrateur du site");
	
	if($_POST['type'] == 'ajcompte'){
		$login = $_POST['username'];
		$passwd = $_POST['password'];
		$requete = "INSERT INTO utilisateur SET login='$login', mdp=PASSWORD('$passwd')";
		$result = mysqli_query($bdd, $requete);
	
	}
	if($_POST['type'] == 'dlcompte'){
		$login = $_POST['username'];
		$requete = "DELETE FROM connexion WHERE login='$login'";
		$fhkgte = mysqli_query($bdd, $requete);
		$requete = "DELETE FROM utilisateur WHERE login='$login'";
		$result = mysqli_query($bdd, $requete);
	}
	if($_POST['type'] == 'updatepasswd'){
		if($_POST['pass1'] == $_POST['pass2']){
			$_SESSION['update'] = true;
			$pass = $_POST['pass1'];
			$requete = "UPDATE utilisateur SET mdp=PASSWORD('$pass') WHERE login='$user' ";
			$result = mysqli_query($bdd, $requete);
		}
		else{
			$_SESSION['update'] = false;
		}
	}
	if($_POST['type'] == 'intervalle'){
		$delai = $_POST['intervalle'];
		$requete = "UPDATE peripherique SET delai='$delai'";
		$result = mysqli_query($bdd, $requete);
		$_SESSION['update'] = true;
		
		}
	$adresse = $_SERVER['HTTP_REFERER'];
	echo "<a href='$adresse'>Cliquez ici si votre navigateur ne vous redirige pas automatiquement</a>";
	
?>
</center>
</body>
</html>