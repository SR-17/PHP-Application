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
	<div class="page_title"><h2 style="text-align:center;">Mon Profil</h2></div>
	<?php
	drawProfil();

	?>
</section>

	</section>
</br>





</br>




</br>

	</section>

<section>

</section>

<?php 
	if(file_exists('includes/footer.php')){
		require('includes/footer.php');	
	}
?>
</body>






</html>