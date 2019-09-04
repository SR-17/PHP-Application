<?php session_start()?>
<?php
include('includes/members.php');
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
		include_once('login.php');	
	} ?>
	</section>


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