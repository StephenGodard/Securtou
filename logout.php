<html>
<head>
<title>Deconnexion</title>
<?php
$adresse = $_SERVER['HTTP_REFERER'];
echo "<meta http-equiv=\"refresh\" content=\"0; URL=$adresse\">";

?>
</head>
<body>
<center>
<?php
session_start();
	session_destroy();
		$adresse = $_SERVER['HTTP_REFERER'];
	echo "<a href=\"$adresse\">Cliquez ici si votre navigateur ne vous redirige pas automatiquement</a>";
?>
</center>
</body>
</html>