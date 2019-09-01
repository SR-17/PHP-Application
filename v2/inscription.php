<?php
include('includes/members.php');
?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="includes/style.css">

</head>

<body>
<?php
		include('includes/header.php');

		?>
	<div class="page_title"><h2 style="text-align:center;">Inscription</h2></div>

<?php
	if(file_exists('includes/register.php')){
		require('includes/register.php');	
	} ?>
	</section>
</br>





</br>




</br>
	</section>
</body>
<?php 
	if(file_exists('includes/footer.php')){
		require('includes/footer.php');	
	}
?>
</html>