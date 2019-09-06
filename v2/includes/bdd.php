<?php
try{
			$bdd = new PDO('mysql:host=localhost;dbname=utilisateurs','','');
			$bdd ->exec('SET NAMES utf8'); // Recevoir les requêtes encodées en UTF-8
			}catch(Exception $e){
			
		}
?>
