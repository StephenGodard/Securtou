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
				echo '<h1>Historique des connexions</h1>';
				$bdd = mysqli_connect("localhost", "root", "MySQL", "projet");
				$result = mysqli_query($bdd, "SELECT * from connexion");
				$enr = mysqli_fetch_array($result);
				$inc = 0;
				$i = 0;
				$plus = 0;
				$moins = 0;
				$cond = 0;
				if(isset($_GET['page']) == TRUE)
					$inc = $_GET['page']-1;
				while( $enr != FALSE ) {
					
					$i = $i+1;
					if($i >= ($inc*30)+1 && $i <= ($inc*30)+30){
						echo"$enr[num] | $enr[date] | $enr[heure] | $enr[ip] | $enr[login]<br>";
						
						
						
					}
					$enr = mysqli_fetch_array($result);
					
					if($i < $inc*30)
						$moins = $moins + 1;
						continue;
					if($i >= ($inc*30)+30)
						$plus = $plus + 1;
						break;
					
				}
			echo "<br><center>";
			$pagem = $inc+2;
			if($moins > 0)
					echo"<a href='histo.php?page=$inc'>Pr&eacute;c&eacute;dent</a> ";
			if($cond == 6)
					echo"<a href='histo.php?page=$pagem'>Suivant</a>";
			echo"</center>";
				
			}
			?>
			</div>
		</div>
</div>
<div class="footer"></div>
</body>
</html>