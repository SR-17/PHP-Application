<?php

	if(!isLogged()){ 
	echo '<section><h3 style="text-align:center;">Connexion</h3><form action="index.php" method="POST">
			Pseudo :<input type="text" maxLength="200" name="pseudo">
			Mot de passe : <input type="password" maxLength="200" name="password" />
			<input type="submit" value="Se connecter"/>
			</form><h4 style="text-align:center;">Si vous n\'avez pas de compte, veuillez vous rendre <a href=\'includes/register.php\'>ici</a></h4></section>';
	}
	
	if(isset($_POST['pseudo'])){
		
		$password_to_check = $_POST['password'];
		
		include('bdd.php');
		
		$requete = $bdd->prepare('SELECT id,password FROM membres WHERE pseudo = :pseudo');
		$requete->execute(array('pseudo'=>$_POST['pseudo']));
		$lines= $requete->fetch();
		
		
		if($lines != NULL){
			if(password_verify($_POST['password'],$lines['password']) == TRUE){
			    connect();
			}	
			else{ 
				
				echo "<section class='accessdenied'>Mauvais pseudo ou mot de passe</section>";
			
			}
			
		
		
		}else{
			$_POST['pseudo'] = '';
			$_POST['password'] = '';
			echo "<section class='accessdenied'>Mauvais pseudo ou mot de passe</section>";
			}
	}

?>