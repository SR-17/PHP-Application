<?php
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
	if(isset($_SESSION['pseudo']) && !is_null($_SESSION['pseudo'])){
		return TRUE;
	}else{
		return FALSE;
	}
}
function start_session(){
	
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
}
function stop_session(){
	if(session_status() == PHP_SESSION_ACTIVE){
	session_abort();
	}
}
function get_configuration(){ 
	// sert a rien pour l instant
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
		echo "</br>Titre du message : <input type='text' name='titre'>";
		echo "</br>";
		echo "Votre demande : <input type='text' name='message' maxLength=250>";
		echo "</br>";
		echo "<input type='submit' value='Envoyer'>";
		echo '</form>';
		echo '</section>';
	}else{
		if(!isset($_POST['message']) && !isset($_POST['titre']) && !isset($_POST['pseudo'])){
		echo '<section>';
        echo '<h4 style="text-align:center;">Vous devez être connecté pour pouvoir utiliser le formulaire contact.</h4>';
		echo '<h4 style="text-align:center;">Si vous n\'avez pas de compte, veuillez vous rendre <a href=\'inscription.php\'>ici</a></h4></section>';
		}
	}
	
}
function drawProfil(){
	if(isLogged()){
		
	$req_obj = getUserDBInfo();
	$user_info = $req_obj->fetch();
	echo '<section class="profil"> 
		<h3>Bienvenue sur votre profil '.$_SESSION['pseudo'].'</h3></br>
		</br>Votre email :<input type="text" value="'.$user_info['mail'].'"/>
		</br>Date d"inscription :<input type="text" value="'.$user_info['date'].'"/>
	<form action="profil.php" method="POST">
	
		<input type="submit" value="Mettre à jour mon profil"/>
		<input type="
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
 function isValidPseudo($pseudo){
		include('bdd.php');
		$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo');
		$req->execute(array('pseudo' => $_POST['pseudo']));
		$res = $req->fetch();
		if(empty($res['pseudo'])){
				return TRUE;
		}else{
			echo '<section class="mail_not_valid">Impossible de continuer : Ce pseudo est déjà utilisé ! </section>';
			return FALSE;
		}
		$req->closeCursor();
}
function isValidMail($mail){
	if(strstr($_POST['mail'],'@') && strstr($_POST['mail'],'.')){
		echo "OK !";
		return TRUE;
	}else{
		echo '<section class="mail_not_valid">Impossible de continuer : Veuillez entre un email valide ! </section>';
		return FALSE;
	}
}
function isPasswordMatching($password,$tocompare){
	if($password == $tocompare){
		return TRUE;
	}else{
		echo '<section class="password_not_matching">Impossible de continuer : Veuillez confirmer votre mot de passe ! </section>';
		return FALSE;
	}
}
function isValidPassword($password){
	if(!empty($password)){
		return TRUE;
	}else{
		echo 'PASSWORD';
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
function isValidNews($author,$title,$date,$data){
	if(is_string($author) && is_string($title) && is_string($data)){
		return TRUE;
	}else{
		return FALSE;
	}
}
function createMember($pseudo,$password,$mail){
	if(TRUE){
		include('bdd.php');
		$req = $bdd->prepare('INSERT INTO membres(pseudo,password,mail,date) VALUES (:pseudo,:password,:mail,:date)');
		$encrypted_password = password_hash($password,PASSWORD_DEFAULT);
		$req->execute(array('pseudo' => $pseudo,'password' => $encrypted_password, 'mail' => $mail,'date'=> date()));
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
}
function isAdmin(){ 
	$a = 'admin';
	include('db.php');
	$req = $bdd->prepare('SELECT * from utilisateur WHERE group_policy=:AD pseudo=:pseudo');
	$req->execute(array('AD' => $a,'pseudo' => $_SESSION['pseudo']));
	$req->fetch();
	if($req){
		return TRUE;
	}else{
		return FALSE;
}
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
		die();
		return FALSE;
	}
	$req->closeCursor();
}
?>