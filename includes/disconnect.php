<?php
	include_once('members.php');
	
	if(isset($_POST['disconnect'])){
		$_POST = array();
		disconnect();
		echo '<center><h3>Vous avez été deconnecté</h3></center>';
		echo '<script>a=function()
		{
			window.location = "../index.php"; 
		};
			window.setTimeout(a,2000);</script>';
	}
	?>