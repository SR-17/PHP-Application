<?php session_start()?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="includes/style.css">
<link href="includes/script.js" type="javascript"/>
</head>

<body>
<?php
	if(file_exists('includes/header.php')){
		include_once('includes/header.php');
	}
	
	?>
		
	<div class="page_title"><h2 style="text-align:center;">Accueil</h2></div>

<?php
	if(isLogged()){
		echo '<section>Bienvenue</br>';
			
		}else{
		if(file_exists('includes/login.php')){
		include_once('includes/login.php');
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
		include_once('includes/footer.php');	
	}
?>
</body>






</html>