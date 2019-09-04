<?php session_start()?>
<?php
	   include_once('includes/members.php');
        

if(isset($_POST['profil_signature'])){
			$signature = $_POST['profil_signature'];
			if(isSignatureOverflowing($signature) && isSignatureValid($signature)){
				updateProfil($signature);
			}
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
		include_once('includes/footer.php');	
	}
?>
</body>






</html>