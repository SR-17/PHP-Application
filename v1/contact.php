<?php
if(file_exists('includes/members.php')){
	require_once('includes/members.php');
	start_session(); 
}
?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="includes/style.css">

</head>

<body>
<?php
	if(file_exists('includes/header.php')){
		require_once('includes/header.php');
	}
		?>
	<div class="page_title"><h2 style="text-align:center;">Formulaire de contact</h2></div>

<?php

	if(isLogged()){
		drawContact();
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
		require('includes/footer.php');	
	}
?>
</body>

</html>