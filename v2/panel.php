<html>
<?php require('includes/admin_function.php'); ?>
<head>
<script>
 function update(){
    var listbox = document.getElementById('2');
    var textbox = document.getElementById('1');
    textbox.value = listbox.value;
 }
 function hide(){
    var a = document.getElementById('a');
    var b = document.getElementById('b');
    b.value = a.value;

 }

</script>
<style>
body{
}
#news_formulaire{
float:left;
}
#utilisateur{
	border: solid black 0.1em;
}


</style>



</head>



<body>
<center>
<h2>Administration</h2>
<div class="utilisateur">
<b>Gérer vos utilisateurs</b>
    <?php showUser(); ?> 
</br>
</br>
    Supprimer l'utilisateur : <form type="POST" action="process.php"><input id="1"readonly type="text" onload="hide()" name="deleteuser"></br></br><input type="submit" value="Confirmer la suppression de l'utilisateur"/></form>
</br>
</div><div class="news_formulaire">
<b>Vos news :</br></b><?php showNews(); ?></br>
</br></div>
<?php showNewsWriter();  ?>


</br>
</br>
    Envoyer message : <form type="POST" action="process.php">Pseudo <input id="1" type="pseudo">Auteur: <input id="2" type="text"  name="auteur">Destinaire :<input id="3" name="cible" type="text">Message: <textarea></textarea><input id="3" type="text" ></br></br><input type="submit" value="Confirmer la suppression de l'utilisateur"></input></form>




</center>
</body>

</html>