<?php session_start()?>
<?php
if(file_exists('includes/members.php')){
	  _once_once_once('includes/members.php');
}
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="includes/style.css">

</head>

<body>
<?php
	if(file_exists('includes/header.php')){
		include_once('includes/header.php');
	}
		?>
	<div class="page_title"><h2 style="text-align:center;">Formulaire de contact</h2></div>

<?php

	if(isLogged()){
		drawContact();
	}else{
		echo "<center><section><h4> Vous devez être connecté pour pouvoir me contacter !
		</br></h4><h3>Vous allez être rediriger vers l'accueil</h3></section></center>";
		echo'<script>
				a = function(){
				window.location = "index.php";
				};
				window.setTimeout(a,3000);
			</script>';

	}
																		
		if(isset($_POST['message']) && isset($_POST['pseudo']) && isset($_POST['titre'])){
			$titre = $_POST['titre'];
			$message = $_POST['message'];
			$pseudo = $_POST['pseudo'];
			
			if(!isContactOk($titre,$message,$pseudo)){
				echo '<h4 style="text-align:center;">Impossible d"envoyer le formulaire de contact ! Veuillez reessayez en cliquant ici </h4>';
				$_POST = array();
				echo 'Veuillez reessayez en cliquant ici';
			}else{
				SendContact($titre,$pseudo,$message,date('d , j , y , H'));
			}
		
	}
	
	?>
	

	</section>
</br>





</br>




</br>

	</section>
<?php 
	if(file_exists('includes/footer.php')){
		include_once_once('includes/footer.php');	
	}
?>
</body>

</html>