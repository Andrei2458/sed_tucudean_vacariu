<?php

	include('config/db_connect.php');


	$erori = array('tip' =>'', 'rasa'=>'','culoare'=>'', 'varsta'=>'', 'sex'=>'', 'nume'=>'');
	if(isset($_POST['submit'])){
		
		if(empty($_POST['tip'])){
			$erori['tip'] = 'Alegeti tipul animalului <br />';
		}
		else{
			$tip = $_POST['tip'];
			if(!preg_match('/(caine|pisica)/', $tip)){
				$erori['tip'] = 'Campul tip poate contine doar caine sau pisica';
			}
		}

		if(empty($_POST['rasa'])){
			$erori['rasa'] = 'Alegeti rasa animalului <br />';
		}
		else{
			$rasa = $_POST['rasa'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $rasa)){
				$erori['rasa'] = 'Campul rasa poate contine doar litere mari si mici, spatii';
			}
		}

		if(empty($_POST['culoare'])){
			$erori['culoare'] = 'Alegeti culoarea animalului <br />';
		}
		else{
			$culoare = $_POST['culoare'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $culoare)){
				$erori['culoare'] = 'Campul culoare poate contine doar litere mari si mici, spatii';
			}
		}

		if(empty($_POST['varsta'])){
			$erori['varsta'] = 'Alegeti varsta animalului <br />';
		}
		else{
			$varsta = $_POST['varsta'];
			if(!filter_var($varsta, FILTER_VALIDATE_INT)){
				$erori['varsta'] = 'Introduceti o varsta valida';
			}
		}

		if(empty($_POST['sex'])){
			$erori['sex'] = 'Alegeti sexul animalului <br />';
		}
		else{
			$sex = $_POST['sex'];
			if(!preg_match('/(mascul|femela)/', $sex)){
				$erori['sex'] = 'Sexul poate fi doar mascul sau femela';
			}
		}

		if(empty($_POST['nume'])){
			$erori['nume'] = 'Alegeti numele animalului <br />';
		}
		else{
			$nume = $_POST['nume'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $nume)){
				$erori['nume'] = 'Numele poate contine doar litere mari si mici, spatii';
			}
		}

		
		if(array_filter($erori)){
			//daca am avea erori...
		}
		else{
			//cand nu avem erori

			$tip = mysqli_real_escape_string($conexiune, $_POST['tip']);
			$culoare = mysqli_real_escape_string($conexiune, $_POST['culoare']);
			$varsta = mysqli_real_escape_string($conexiune, $_POST['varsta']);
			$sex = mysqli_real_escape_string($conexiune, $_POST['sex']);
			$nume = mysqli_real_escape_string($conexiune, $_POST['nume']);
			$rasa = mysqli_real_escape_string($conexiune, $_POST['rasa']);

			// sql
			$sql = "INSERT INTO animale(tip_animal, rasa, culoare, varsta, sex, nume) VALUES('$tip', '$rasa', '$culoare', '$varsta', '$sex',  '$nume')";

			// salvare cu verificare in db
			if(mysqli_query($conexiune, $sql)){
				// succes
				header('Location: index.php');	
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
		<h4 class="center">Adaugă un animăluț</h4>
		<form class="white" action= "add.php" method="POST">
			<!--tip-->
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="tip">
          		<label>Tip animăluț:</label>
          		<span class="helper-text">câine sau pisică</span>
			</div>

			<div class = "red-text"><?php echo $erori['tip']; ?></div>
		
			<!--rasa-->
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="rasa">
          		<label>Rasă:</label>
			</div>
			<div class = "red-text"><?php echo $erori['rasa']; ?></div>
			
			<!--culoare-->
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="culoare">
          		<label>Culoare:</label>
			</div>
			<div class = "red-text"><?php echo $erori['culoare']; ?></div>

			<!--varsta-->
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="varsta">
          		<label>Vârstă:</label>
          		<span class="helper-text">exprimată în ani</span>
			</div>
			<div class = "red-text"><?php echo $erori['varsta']; ?></div>

			<!--sex-->
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="sex">
          		<label>Sex:</label>
          		<span class="helper-text">mascul sau femelă</span>
			</div>
			<div class = "red-text"><?php echo $erori['sex']; ?></div>

			<!--nume-->
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="nume">
          		<label>Nume:</label>
			</div>
			<div class = "red-text"><?php echo $erori['nume']; ?></div>
			<div class = "red-text text-lighten-2">Observație: Toate câmpurile sunt obligatorii!</div>
			<div class="center">
				<input type="submit" name="submit" value="Adaugă" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>