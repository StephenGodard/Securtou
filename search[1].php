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
				$_SESSION['monUrl'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
				echo '<h1>Donn&eacute;es</h1>';
				echo "<form method='get' action='search.php'>Selectionez la date
						<select name='j'>";
						$i = 01;
						while($i < 32){
							echo"<option value=$i>$i</option>";
							$i++;
							}
				echo "</select><select name='m'>
						<option VALUE=01>Janvier</option>
						<option VALUE=02>F&eacute;vrier</option>
						<option VALUE=03>Mars</option>
						<option VALUE=04>Avril</option>
						<option VALUE=05>Mai</option>
						<option VALUE=06>Juin</option>
						<option VALUE=07>Juillet</option>
						<option VALUE=08>Ao&ucirc;t</option>
						<option VALUE=09>Septembre</option>
						<option VALUE=10>Octobre</option>
						<option VALUE=11>Novembre</option>
						<option VALUE=12>D&eacute;cembre</option>
						</select> au 
						<select name='toj'>";
						$i = 01;
						while($i < 32){
							echo"<option value=$i>$i</option>";
							$i++;
							}
				echo "</select><select name='tom'>
						<option VALUE=01>Janvier</option>
						<option VALUE=02>F&eacute;vrier</option>
						<option VALUE=03>Mars</option>
						<option VALUE=04>Avril</option>
						<option VALUE=05>Mai</option>
						<option VALUE=06>Juin</option>
						<option VALUE=07>Juillet</option>
						<option VALUE=08>Ao&ucirc;t</option>
						<option VALUE=09>Septembre</option>
						<option VALUE=10>Octobre</option>
						<option VALUE=11>Novembre</option>
						<option VALUE=12>D&eacute;cembre</option>
						</select><input type='submit' value='Valider'><br><br>";
				$bdd = mysqli_connect("localhost", "root", "MySQL", "projet");
			if(isset($_GET['j']) == true){
				$date = "2017-".$_GET['m']."-".$_GET['j'];
				if($_GET['m'] > $_GET['tom'])
					$result = mysqli_query($bdd, "SELECT * from donnee WHERE date='$date'");
				else if($_GET['m'] == $_GET['tom'] && $_GET['j'] > $_GET['toj'])
					$result = mysqli_query($bdd, "SELECT * from donnee WHERE date='$date'");
				else{
					$date2 = "2017-".$_GET['tom']."-".$_GET['toj'];
					$result = mysqli_query($bdd, "SELECT * from donnee WHERE date BETWEEN '$date' AND '$date2'");
				}
				}
			else {
				$result = mysqli_query($bdd, "SELECT * from donnee");
				}
				$enr = mysqli_fetch_array($result);
				$inc = 0;
				$i = 0;
				$plus = 0;
				$moins = 0;
				$cond = 0;
				if($enr != FALSE)
					echo"<table BORDER=1 CELLPADDING=5><CAPTION> Donn&eacute;es de temp&eacute;rature </CAPTION><tr><th>ID</th><th>DATE</th><th>HEURE</th><th>Temp&eacute;rature</th></tr>";
				else
					echo"<h1>Aucune donn&eacute;e trouv&eacute;e</h1>";
				if(isset($_GET['page']) == TRUE)
					$inc = $_GET['page']-1;
				while( $enr != FALSE ) {
					
					$i = $i+1;
					if($i >= ($inc*30)+1 && $i <= ($inc*30)+30){
						echo"<tr><th>$enr[num]</th><td>$enr[date]</td><td>$enr[heure]</td><td>$enr[valeur]&ordm;C</td></tr>";
						$cond++;
						
					}
					$enr = mysqli_fetch_array($result);
					
					if($i < $inc*30)
						$moins = $moins + 1;
						continue;
					if($i >= ($inc*30)+30)
						$plus = $plus + 1;
						break;
					
				}
			echo "</table><br><center>";
			$pagem = $inc+2;
			if($moins > 0){
				if(isset($_GET['j']) == true)
					echo"<a href='$_SESSION[monUrl]&page=$inc'>Pr&eacute;c&eacute;dent</a> ";
				else
					echo"<a href='search.php?page=$inc'>Pr&eacute;c&eacute;dent</a> ";
					}
			if($cond == 30){
				if(isset($_GET['j']) == true)
					echo"<a href='$_SESSION[monUrl]&page=$pagem'>Suivant</a>";
				else
					echo"<a href='search.php?page=$pagem'>Suivant</a>";
					}
			echo"</center>";
				
			}
			?>
			</div>
		</div>
</div>
<div class="footer"></div>
</body>
</html>