<?php

	include('config/db_connect.php');
	$erori = array('numeClient' =>'', 'numarTelefon'=>'', 'email'=>'', 'adresa'=>'');
	if(isset($_POST['submit'])){
		
		if(empty($_POST['numeClient'])){
			$erori['numeClient'] = 'Inserați un numeClient <br />';
		}
		else{
			$numeClient = $_POST['numeClient'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $numeClient)){
				$erori['numeClient'] = 'Numele poate contine doar litere mari si mici, spatii';
			}
		}
		if(empty($_POST['numarTelefon'])){
			$erori['numarTelefon'] = 'Inserați un numar de telefon <br />';
		}
		else{
			$numarTelefon = $_POST['numarTelefon'];
			if(!preg_match('/^[0-9\s]{10}+$/', $numarTelefon)){
				$erori['numarTelefon'] = 'Numarul poate contine doar 10 cifre, fara spatii';
			}
		}
		if(empty($_POST['email'])){
			$erori['email'] = 'Inserați un email <br />';
		}
		else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$erori['email'] = 'Introduceti un email valid';
			}
		}

		//validare adresa
		if(empty($_POST['adresa'])){
			$erori['adresa'] = 'Inserați o adresa <br />';
		}
		else{
			$adresa = $_POST['adresa'];
			if(!preg_match('/[a-zA-Z0-9,\s]+$/', $adresa)){
				$erori['adresa'] = 'Introduceti o adresa valida';
			}
		}
		if(array_filter($erori)){
			//daca am avea erori...
		}
		else{
			//cand nu avem erori

			$numeClient = mysqli_real_escape_string($conexiune, $_POST['numeClient']);
			$numarTelefon = mysqli_real_escape_string($conexiune, $_POST['numarTelefon']);
			$email = mysqli_real_escape_string($conexiune, $_POST['email']);
			$adresa = mysqli_real_escape_string($conexiune, $_POST['adresa']);

			// sql
			$sql = "INSERT INTO clienti (numeClient, numarTelefon, email, adresa) VALUES ('$numeClient', '$numarTelefon', '$email', '$adresa')";

						

			// salvare cu verificare in db
			if(mysqli_query($conexiune, $sql)){
				// succes
				header('Location: lista.php');	
			}
			else{
				//eroare
				echo 'query error: ' . mysqli_error($conexiune);
			}

			
		}
	}



?>
<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>


	<section class="container grey-text text-darken-1">
		<h4 class="center">Creare cont erou</h4>
		<form class="white" action= "client.php" method="POST">
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="numeClient">
          		<label>Nume:</label>
          		
			</div>
        	<div class = "red-text"><?php echo $erori['numeClient']; ?></div>
        	
        	<div class="row">
        		<div class="input-field">
          		<input type="text" name="numarTelefon">
          		<label>Numar telefon:</label>
        	</div>
        	<div class = "red-text"><?php echo $erori['numarTelefon']; ?></div>
			
        	<div class="row">
        		<div class="input-field">
          		<input type="text" name="email">
          		<label>Email:</label>
        	</div>
        	<div class = "red-text"><?php echo $erori['email']; ?></div>

        	<div class="row">
        		<div class="input-field">
          		<input type="text" name="adresa">
          		<label>Adresa:</label>
        	</div>
        	<div class = "red-text"><?php echo $erori['adresa']; ?></div>
        	<div class = "red-text text-lighten-2">Observație: Toate câmpurile sunt obligatorii!</div>

			<br>
			<br>
			<div class="center">
				<input type="submit" name="submit" value="Crează" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>