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