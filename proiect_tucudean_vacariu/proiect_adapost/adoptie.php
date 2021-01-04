<?php

	include('config/db_connect.php');
	$erori = array('idAnimal' =>'', 'idClient'=>'');
	if(isset($_POST['submit'])){
		
		if(empty($_POST['idAnimal'])){
			$erori['idAnimal'] = 'Inserați un id <br />';
		}
		else{
			$idAnimal = $_POST['idAnimal'];
			if(!filter_var($idAnimal, FILTER_VALIDATE_INT)){
				$erori['idAnimal'] = 'Introduceti un id valid';
			}
		}
		if(empty($_POST['idClient'])){
			$erori['idClient'] = 'Inserați un id <br />';
		}
		else{
			$idAdapost = $_POST['idClient'];
			if(!filter_var($idAdapost, FILTER_VALIDATE_INT)){
				$erori['idClient'] = 'Introduceti un id valid';
			}
		}
		if(array_filter($erori)){
			//daca am avea erori...
		}
		else{
			//cand nu avem erori

			$idAnimal = mysqli_real_escape_string($conexiune, $_POST['idAnimal']);
			$idClient = mysqli_real_escape_string($conexiune, $_POST['idClient']);

			// sql

			$sql = "INSERT INTO adoptii (idAnimal, idClient) VALUES ('$idAnimal', '$idClient')";			

			// salvare cu verificare in db
			if(mysqli_query($conexiune, $sql)){
				// succes
				header('Location: istoric.php');	
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
		<h4 class="center">Adopție animăluț</h4>
		<form class="white" action= "adoptie.php" method="POST">
			<div class="row">
        		<div class="input-field col s6">
          			<input type="text" name="idAnimal">
          			<label>id Animal</label>
          			<span class="helper-text">id-ul unui animal care va fi adoptat</span>
          			<div class = "red-text"><?php echo $erori['idAnimal']; ?></div>
        		</div>
        	
			<div class="row">
        		<div class="input-field col s6">
          			<input type="text" name="idClient">
          			<label>id Erou</label>
          			<span class="helper-text">id-ul eroului</span>
          			<span class = "red-text"><?php echo $erori['idClient']; ?></span>
        		</div>
        	
			<br>
			<br>
			<div class="center col s12">
				<input type="submit" name="submit" value="Adoptă" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>