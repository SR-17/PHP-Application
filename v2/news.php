<?php
include('members.php');
start_session();
?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<?php
		include('header.php');

		?>


<?php
	if(file_exists('login.php')){
		require('login.php');	
	} ?>
	</section>
SECTION PRINCIPALE DU SITE INTERNET 


LE CONTENU SERA AFFICHE ICI.

</br>





</br>




</br>



<?php drawProfil(); ?>

	</section>

<section>

<?php include('register.php'); ?>

</section>
</body>






</html>