
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
	if(file_exists('includes/disconnect.php')){
	require_once('includes/disconnect.php');
	}
	if(file_exists('includes/header.php')){
		require_once('includes/header.php');
	}
	
	?>
		
	<div class="page_title"><h2 style="text-align:center;">Accueil</h2></div>

<?php
	if(isLogged()){
		echo '<section>Bienvenue</section>';
	}else{
		if(file_exists('includes/login.php')){
		require_once('includes/login.php');
		}	
	} 
	
	drawNews();
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