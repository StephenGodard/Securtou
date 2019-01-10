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
				if($_SESSION['admin'] == false)
					die("Vous n'avez pas acc&egrave;s a ces donn&eacute;es");
				echo '<h1>Configuration des p&eacute;ripheriques</h1>';
				echo "<form method='post' action='ajout.php'>Entrez la nouvelle intervalle (en sec) : <input type='text' name='intervalle'><input type='hidden' name='type' value='intervalle'><br><input type='submit' name='Valider' value='Valider'></form>";
				
				if(isset($_SESSION['update']) == true){
					echo 'Intervalle mise &agrave; jour';
					unset($_SESSION['update']);
					}
			}
			?>
			</div>
		</div>
</div>
<div class="footer"></div>
</body>
</html>