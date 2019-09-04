<?php
function showUser(){
    $user = queryAllUsers();
    echo '<select id="2" onchange="update()">';
    $user_count = 5;
    $i = 0;
    while($i != ($user_count-1)){
        $i++;
        $current_user = $user->fetch();
        echo'<option value='.$current_user['pseudo'].'>'.$current_user['pseudo'].'</option>';
    }
    $user->closeCursor();
    echo '</select>';
}
function showNews(){
    include('includes/bdd.php');
	$req = $bdd->prepare('SELECT * FROM news');
	$req->execute();
		if($req == NULL){
			exit();
        }
    echo '<form method="POST" action="process.php"><select id="a" onchange="hide()" name="news"></br>';
    $i = 0;
    while(true){
        $i++;
        $news = $req->fetch();
        if($news == ''){
            break;
        }
        echo'<option name="news" value='.$i.'>'.$news['news_title'].' - de '.$news['news_author'].'</option>';
    }
    echo '<input id="b" name="id" type="text"/>';
    $req->closeCursor();
    echo '</br>';
    echo '<input type="submit" value="Supprimer la news"/>';
    echo '</select></form>';
} 
function showNewsWriter(){
    echo '<section>';
    echo '<form method="POST" action="process.php">';
    echo '<h4>Ecrire une news</h4>';
    echo "</br>";
    echo "</br>Titre de la news : <input type='text' name='titre'>";
    echo "</br>";
    echo "Contenu : <textarea name='contenu' maxLength=250> </textarea>";
    echo "</br>";
    echo "<input type='submit' value='Publier la news'>";
    echo '</form>';
    echo '</section>';
}
function DeleteUser($pseudo){     
    if(isset($_POST['action'])){
        if($_POST['action'] == 'TRUE'){
            if(!isAdmin()){
            $req = $bdd->prepare('DELETE FROM utilisateur WHERE pseudo=:pseudo');
            $req->execute(array('pseudo' => $pseudo));
            echo 'Utilisateur'.$pseudo.' supprimé';
        }
}
}             
}
function queryAllUsers(){
    include_once('includes/bdd.php');
    $req = $bdd->prepare('SELECT * FROM membres');
    $req->execute();
    return $req;
}
function addNews($titre,$contenu){
    include_once('includes/bdd.php');
    $req = $bdd->prepare('INSERT INTO news(titre,contenu) VALUES(:titre,:contenu,:auteur,:date)');
	$req->execute(array('titre' => $titre,'auteur' => $auteur,'contenu' => $contenu,'date' => 0));
		if($req == NULL){
			exit();
		}
		return $req;
	}
function deleteNews($id){
    echo 'test';
    $id = $id--;
    include_once('includes/bdd.php');
    $req = $bdd->prepare('DELETE FROM news WHERE id=:id');
    $req->execute(array('id' => $id));
    $req->closeCursor();
}



function GetMessagerieQueryHandle(){
	if(file_exists("includes/bdd.php")){
		if(true){
			$pseudo = "test";
			$req = $bdd->prepare('SELECT * FROM mail WHERE pseudo=:pseudo');
				if(!$req){
					echo 'Une erreur est survenu. Les administrateurs ont étaient contacté et résoudrons le problème dès que possible. Veuillez m excusez.';
				}
				$req->execute(array("pseudo"=>$pseudo));
				if(!$req == 0) {
					return $req;
				}
	}
	}
	
}
function readMails($res){ // Lis les messages
	$mail_data = $res['mail'];
	$size = strlen(mail_data);
	$i = 0;
	if($size != 0){
		while($i != size){
			$i++;
			echo $mail_data[$i];
		}
	}


}
function messagerie(){ // affiche la messagerie
	$query = GetMessagerieQueryHandle();
	if($query == 0){
		echo '<h3 style="color:red;">Une erreur est survenu. Veuillez contactez le webmaster !';
		return 0;
	}else{
		$handle = GetMessagerieQueryHandle();
		readMails($handle);
	}

}
function sendmessage($auteur,$titre,$data,$date){ // envois un message par $_POST['auteur'],$_POST['cible'],$_POST['d
	if(true){
		$pseudo = "test";
		$formated_data = ";startofmessage;" . $auteur . ";" . "titre:" . $titre . ";" . "contenu:" . $data . ";" . "date:" . $date . ";" . ";endofmessage;";
		
		if(file_exists("includes/bdd.php")){
			include_once('includes/bdd.php');
			$req = $bdd->prepare('INSERT INTO messagerie(titre,data,auteur,date) VALUES(:titre,:data,:auteur,:date) WHERE pseudo=:pseudo');
			$res = $req->execute(array('date' => $date,'auteur' => $auteur ,'data' => $formated_data,'pseudo' => $pseudo, 'titre' => $titre));
		if($res != 0){
			echo $formated_data;
		}else{
			echo 'Refus d envois du message : Veuillez vérifier le destinataire';
			return 0;
		}
		}
	
}
}
?>