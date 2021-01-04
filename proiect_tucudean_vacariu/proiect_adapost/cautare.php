<?php

//preluare date de la utilizator
	
	include('config/db_connect.php');
	
	$animale = array('mesajStandard'=>'-');

	$erori = array('tip' =>'', 'rasa'=>'', 'culoare'=>'');
	
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

		if(array_filter($erori)){
			//daca am avea erori...
		}
		else{
			//cand nu avem erori

			$tip = mysqli_real_escape_string($conexiune, $_POST['tip']);
			$culoare = mysqli_real_escape_string($conexiune, $_POST['culoare']);
			$rasa = mysqli_real_escape_string($conexiune, $_POST['rasa']);

			// sql	
			$sql = "SELECT an.idAnimal, an.tip_animal, an.rasa, an.culoare FROM animale an JOIN animal_adapost aa on an.idAnimal=aa.idAnimal WHERE aa.dataAdoptie is NULL AND an.tip_animal='$tip' AND an.rasa = '$rasa' AND an.culoare='$culoare'";		
			// salvare rezultate
			$rezultate = mysqli_query($conexiune, $sql);

			// transpunere rezultate intr-un array asociativ -ala cu rezulta in el
			$animale = mysqli_fetch_all($rezultate, MYSQLI_ASSOC);

			//eliberare memorie
			mysqli_free_result($rezultate);

			// inchidere conexiune
			mysqli_close($conexiune);

			//print_r($animale);
			

			
		}
	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	

	<!-- Formular cautare -->

	<section class="container grey-text text-darken-1">
		<h4 class = 'center grey-text text-darken-1'>Căutare</h4>
		<form class="white" action= "cautare.php" method="POST">
			<div class="row">
        		<div class="input-field">
          		<input type="text" name="tip">
          		<label>Tip animal:</label>
          		
			</div>
        	<div class = "red-text"><?php echo $erori['tip']; ?></div>
        	
        	<div class="row">
        		<div class="input-field">
          		<input type="text" name="rasa">
          		<label>Rasa:</label>
        	</div>
        	<div class = "red-text"><?php echo $erori['rasa']; ?></div>
			
        	<div class="row">
        		<div class="input-field">
          		<input type="text" name="culoare">
          		<label>Culoare:</label>
        	</div>
        	<div class = "red-text"><?php echo $erori['culoare']; ?></div>
        	<div class = "red-text text-lighten-2">Observație: Toate câmpurile sunt obligatorii!</div>
			<br>
			<br>
			<div class="center">
				<input id="search" type="submit" name="submit" value="Caută" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
	<?php if(count($animale) > 0){ ?>

	
	<!-- Afisare rezultate -->
	<section class="container grey-text text-darken-1">
	<h5 id="titluRezultate" class = 'center grey-text text-darken-1'>Rezultate căutare</h5>
	<table id="resultTable" class=" centered striped">
		<div class="responsive-table">
        <thead>
          <tr>
              <th>Id Animal</th>
              <th>Tip Animal</th>
              <th>Rasă</th>
              <th>Culoare</th>
              

          </tr>
        </thead>

        <tbody>
        	<!--
        	<?php 
        		//erorile din php nu mai sunt vizibile utilizatorului
        		error_reporting(0); 
        	?>
			-->
         	<?php foreach ($animale as $animal) { ?>
				<tr>
					<td><?php echo htmlspecialchars($animal['idAnimal']); ?></td>
					<td><?php echo htmlspecialchars($animal['tip_animal']); ?></td>
					<td><?php echo htmlspecialchars($animal['rasa']); ?></td>
					<td><?php echo htmlspecialchars($animal['culoare']); ?></td>
				</tr>
			<?php } ?>
        </tbody>
        </div>
      </table>
    <?php }
    else{ ?>
    	<h5 class = 'center grey-text text-darken-1'>Căutarea nu a oferit niciun rezultat.</h5>
    <?php } ?>
	</section>

    

	<?php include('templates/footer.php'); ?>

</html>