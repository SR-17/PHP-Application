<?php
if(session_status() != "PHP_SESSION_ACTIVE"){ // Indispensable
	session_start();
}
// ***** PARTIE  : General ***** 
function isContactOk($pseudo,$title,$message){
	if(isPseudoOk($pseudo) && isTitleOk($title) && isMessageOk($message)){
		return TRUE;
	}else{
	return FALSE;
	}	
			}
function isMessageOk($message){
				if(strlen($message) > 250){
					return FALSE;
				}else{
					return TRUE;
				}
			}
function isPseudoOk($pseudo){
	if(strlen($_POST['pseudo']) > 50){
		return FALSE;
	}else{
		return TRUE;
	}
	}
function isTitleOk($titre){
	if(is_integer($titre) && strlen($titre) > 50){
		return FALSE;				
	}else {
		return TRUE;
		}
			}
function isLogged(){
	if(isset($_SESSION['pseudo'])){
		return TRUE;
	}else{
		return FALSE;
	}
}
function get_configuration(){ 
	$files = fopen('variables.txt','r');
	if($files != NULL){
	return $files;
	}
}
function getNewsDBInfo(){
	include('includes/bdd.php');
	$req = $bdd->prepare('SELECT * FROM news ORDER BY news_id DESC ');
	$req->execute();
		if($req == NULL){
			echo 'ERREUR : IMPOSSIBLE DE RECUPERER LA NEWS';
			exit();
		}
		return $req;
	}
function drawContact(){
	$_POST['pseudo'] = $_SESSION['pseudo'];
	if(isLogged()){
		$_POST['pseudo'] = $_SESSION['pseudo'];
		echo '<section>';
		echo '<form method="POST" action="contact.php">';
		echo '<h4>Contacter le staff</h4>';
		echo "Votre pseudo : ".$_SESSION['pseudo'];
		echo "</br>";
		echo "</br>Titre du message :</br> <input type='text' name='titre'>";
		echo "</br>";
		echo "Votre demande :</br> <input type='text' name='message' maxLength=250>";
		echo "</br>";
		echo "<input type='submit' value='Envoyer'>";
		echo '</form>';
		echo '</section>';
	}else{
		if(!isset($_POST['message']) && !isset($_POST['titre']) && !isset($_POST['pseudo'])){
		echo '<section>';
        echo '<h4 style="text-align:center;">Vous devez être connecté pour pouvoir utiliser le formulaire contact.</h4>';
		echo '<h4 style="text-align:center;">Si vous n\'avez pas de compte, veuillez vous rendre <a href="inscription.php">ici</a></h4></section>';
		}
	}
	
}
function drawProfil(){
	if(isLogged()){
		
	$req_obj = getUserDBInfo();
	$user_info = $req_obj->fetch();
	echo '<section class="profil"> 
		<h3>Bienvenue sur votre profil '.$_SESSION['pseudo'].'</h3></br>
	<form action="profil.php" method="POST">
	</br>Votre email :<input type="text" value="'.$user_info['mail'].'"/>
		</br>Date d"inscription :<input type="text" value="'.$user_info['date'].'"/>
		</br>Signature :<input type="text" name="profil_signature" value="'.$user_info['signature'].'">
		</br>

		<input type="submit" value="Mettre à jour mon profil"/>
	</form>
	</section>';
	}else{
		echo '<section>';
        echo '<h4 style="text-align:center;">Vous devez être connecté pour voir votre profil</h4>';
		echo '<h4 style="text-align:center;">Si vous n\'avez pas de compte, veuillez vous rendre <a href=\'inscription.php\'>ici</a></h4></section>';
		
	}	
}	
function drawNews(){
	$count = 5;
	if(isset($_GET['count'])){
		$count = $_GET['count'];
		if(is_int($count)){
			if($count > 10){
				$count = 5;
			}else{
				$count = $_GET['count']; // Sinon ce n'est pas un integer alors on lui affecte un integer
			}
		}
	}
	$i = 0;
		while($i != ($count-1)){
			$i = $i+1;
			$req = getNewsDBInfo();
			$res = $req->fetch();
			echo '<section class="news">';
			echo '<h3>  '.$res['news_title'].'  '.$res['news_date'].' de  '.$res['news_author'].'  '.'</h3>';
			echo '</br>';
			echo $res['news_data'];
			echo '</section>';
		}
		$req->closeCursor();
}
// ***** PARTIE  : Membres *****
// Ici
 function isValidPseudo($pseudo){
		include('bdd.php');
		$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo');
		$req->execute(array('pseudo' => $_POST['pseudo']));
		$res = $req->fetch();
		if(empty($res['pseudo'])){
				return TRUE;
		}else{
			echo '<center><h3>Impossible de continuer : Ce pseudo est déjà utilisé !</h3></center>';
			echo'<script> a = function(){window.locations("inscription.php")}; window.setTimeout(a,3000);</script>';
			return FALSE;
		}
		$req->closeCursor();
}
function isValidMail($mail){
	if(strstr($_POST['mail'],'@') && strstr($_POST['mail'],'.')){
		echo "OK !";
		return TRUE;
	}else{
		echo '<center><h3>Impossible de continuer : Votre addresse email n\'est pas valide ! !</h3></center>';
		echo'<script> a = function(){window.locations("inscription.php")}; window.setTimeout(a,3000);</script>';
		return FALSE;
	}

}
function isPasswordMatching($password,$tocompare){
	if($password == $tocompare){
		return TRUE;
	}else{
		echo '<center><h3>Impossible de continuer : Veuillez confirmer votre mot de passe une deuxième fois.</h3></center>';
		echo'<script> a = function(){window.locations("inscription.php")}; window.setTimeout(a,3000);</script>';
		return FALSE;
	}
}
function updateProfil($value,$pseudo){ // This function assume every value is checked before
	require('bdd.php');
	$req = $bdd->prepare('INSERT INTO membres(signature) VALUES(:signature) WHERE pseudo=:pseudo');
	$req->execute(array('pseudo' => $pseudo,'signature' => $value));
	$req->closeCursor();
}
function isSignatureOverflowing($signature){
	if(strlen($username) > 30){
		$_POST = array();
		header('Location : profil.php',304);
	}
}
function isSignatureValid($signature){
	$regex_signature = '*';
	if(preg_match($regex_signature,$mail)){
		return TRUE;
	}else{
		return FALSE;
	}
}
function isValidPassword($password){
	if(!empty($password)){
		return TRUE;
	}else{
		echo '<center><h3>Impossible de continuer : Le mot de passe  n est déjà utilisé !</h3></center>';
		echo'<script> a = function(){window.locations("inscription.php")}; window.setTimeout(a,3000);</script>';
		return FALSE;
	}
}
function isFormatOk($pseudo,$password,$mail){
	if(isValidPseudo($pseudo) && isValidPassword($password) && isValidMail($mail)){
		return TRUE;
	}else{
		return FALSE;
		exit();
	}
}
function createMember($pseudo,$password,$mail){ // Ici on considère que toutes les valeurs sont parfaitement sûrs.
	if(TRUE){
		include('bdd.php');
		$date = date('d.m.y');
		$req = $bdd->prepare('INSERT INTO membres(pseudo,password,mail,date) VALUES (:pseudo,:password,:mail,:date)');
		$encrypted_password = password_hash($password,PASSWORD_DEFAULT);
		$req->execute(array('pseudo' => $pseudo,'password' => $encrypted_password, 'mail' => $mail,'date'=> $date));
		return TRUE;
	}else{
		return FALSE;
	}

}
function isValidNews($author,$title,$date,$data){
	if(is_string($author) && is_string($title) && is_string($data)){
		return TRUE;
	}else{
		return FALSE;
	}
}
function disconnect(){
	$_SESSION = array();
	}
function connect(){
	$_SESSION['pseudo'] = $_POST['pseudo'];
	$_POST = array();
	header("Location: index.php","303");
}
function SendContact($titre,$pseudo,$message,$date){
	include('bdd.php');
	$req = $bdd->prepare('INSERT INTO contact(pseudo,titre,contenu,date) VALUES(:pseudo,:titre,:contenu,:date)');
	$req->execute(array('pseudo' => $pseudo,'titre' => $titre,'contenu' => $message,'date' => $date));
	echo  '<h4 style="text-align:center;">Votre message a bien été envoyer ! Nous vous répondrons directement dans votre boite de message le plus vite possible </h4>';
	$req->closeCursor();
	$_POST = array();
}
function getUserDBInfo(){
	
	
	$pseudo = $_SESSION['pseudo'];
	
	include('bdd.php');
	$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo= :pseudo');
	$req->execute(array('pseudo' => $pseudo));
	if($req != NULL){
		return $req;
	}else{
		echo 'Une erreur est survenu. Veuillez nous excusez pour la gêne occassionnée.';
		exit();
		return FALSE;
	}
	$req->closeCursor();
}
?>