<?php
	require_once('members.php');
	if(isLogged()){
		echo "<form method='POST' action='includes/disconnect.php'>";
		echo "<input type='submit' name='disconnect' value='deconnexion'>";
		echo "</form>";
		
	}
	
	if(isset($_POST['disconnect'])){
		$_POST = array();
		if(isset($_POST['disconnect'])){
			echo 'Ok, ca supprime bien definitivement la declaration du tableau $_POST ainsi que toutes ses valeurs.';
		}
		disconnect();
	}
	
	
	?>