<html>
<head>
<title>Securtou Manager</title>
<link REL=stylesheet HREF="style.css" TYPE="text/css">
</head>
<body>
<div class="header1"><font face="impact" color="white">SECURTOU INC.</font></div>
<div class="corps">
	<div class="banniere"><img src="images/logo.png" /></div>		
		<div class="contenu">
			<div class="sommaire">
			<div class="connect">
			<div class="sconnect"><font face="impact"><center>CONNEXION<center></font></div>
			<center><?php
				session_start();
if(isset($_SESSION["actif"]) == true){
	$nom = $_SESSION["username"];
	echo("Bienvenue $nom <form method=\"post\" action=\"logout.php\"><input type=\"submit\" value=\"Deconnexion\"></form>");
	
	}
else {
echo "<br><form method=\"post\" action=\"login.php\">
<input type=\"text\" name=\"user\" style=\"color:gray;\" value=\"Nom\" onfocus=\"this.style.color='black';if(this.value==this.defaultValue)this.value='';\" />
<br><input type=\"password\" name=\"password\" style=\"color:gray;\" value=\"password\" onfocus=\"this.style.color='black';if(this.value==this.defaultValue)this.value='';\" />
<input type=\"submit\" name=\"Connexion\" value=\"Connexion\">
</form>";
}
			?></center></div>
		<?php
			if(isset($_SESSION["actif"]) == true){
				echo"<center><div class='som1'>
						<div class='ssom1'><font face='impact'>ADMINISTRATION</font></div>
						<a href='compte.php'>Gestion des comptes</a><br>";
				if($_SESSION["admin"] == true){
					echo "
						
						<a href='config.php'>Configuration</a><br>
						<a href='histo.php'>Historique connexion</a><br>
						";
					}
				echo"</div></center>
						<center><div class='som2'>
						<div class='ssom2'><font face='impact'>RESULTATS</font></div>
						<a href='search.php'>Rechercher</a><br>
						<a href='direct.php'>Temps r&eacute;el</a><br>
						</div></center>";
					
				}
			?>
				</div>
			<div class="news2">
				<?php
			if(isset($_SESSION["actif"]) == FALSE)
					die("Vous n'avez pas acc&egrave;s a ces donn&eacute;es");
			if(isset($_SESSION['actif']) == true){
				echo'
				<h3>Modifier votre mot de passe :</h3>
				<form method="post" action="ajout.php">Mot de passe: <input type="password" name="pass1"><br>Confirmez : <input type="password" name="pass2"><br><input type="submit" name="Envoi" value="Envoi" /><input type="hidden" name="type" value="updatepasswd" /></form>';
				if(isset($_SESSION['update']) == TRUE){
					if($_SESSION['update'] == TRUE)
						echo"<br>Mot de passe chang&eacute;";
					else
						echo"<br>Mot de passe non identiques";
					unset($_SESSION['update']);
				}
				if($_SESSION['admin'] == TRUE){
					$bdd = mysqli_connect("localhost", "root", "MySQL", "projet");
					$result = mysqli_query($bdd, "SELECT login FROM utilisateur");
					$enr = mysqli_fetch_array($result);
					echo'<h3>Creer compte :</h3>
					<form method="post" action="ajout.php">Login : <input type="text" name="username" /><br>Passe : <input type="password" name ="password" /><br><input type="submit" name="Creer compte" value="Creer compte" /><input type="hidden" name="type" value="ajcompte" /></form>
					<h3>Supprimer compte :</h3>
					<form method="post" action="ajout.php">Login : <select name="username">';
					while($enr != false){
						echo"<option value='$enr[login]'>$enr[login]</option>";
						$enr = mysqli_fetch_array($result);
					}
					echo'</select><br><input type="submit" name="Suppr compte" value="Suppr compte" /><input type="hidden" name="type" value="dlcompte" /></form>';
					
					}
				
			}
			?>
			</div>
		</div>
</div>
<div class="footer"></div>
</body>
</html>