<?php
if(isLogged()){
		echo '
		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="profil.php">Mon Profil</a></li>
				<li><a href="contact.php">Me Contacter</a></li>


			</ul>
		</nav>';
	
}else {
	echo "
		<nav>
			<ul>
				<li><a href='index.php'>Accueil</a></li>
				<li><a href='contact.php'>Me Contacter</a></li>
				<li><a href='inscription.php'>M'inscrire</a></li>
			</ul>
		</nav>";
		
}
?>
