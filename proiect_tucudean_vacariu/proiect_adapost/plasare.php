<?php

	include('config/db_connect.php');

	//verificare validitate info din formular
	$erori = array('idAnimal' =>'', 'idAdapost'=>'');
	if(isset($_POST['submit'])){
		//validitate idAnimal
		if(empty($_POST['idAnimal'])){
			$erori['idAnimal'] = 'Inserați un id <br />';
		}
		else{
			$idAnimal = $_POST['idAnimal'];
			if(!filter_var($idAnimal, FILTER_VALIDATE_INT)){
				$erori['idAnimal'] = 'Introduceti un id valid';
			}
		}
		//validitate idAdapost
		if(empty($_POST['idAdapost'])){
			$erori['idAdapost'] = 'Inserați un id <br />';
		}
		else{
			$idAdapost = $_POST['idAdapost'];
			if(!filter_var($idAdapost, FILTER_VALIDATE_INT)){
				$erori['idAdapost'] = 'Introduceti un id valid';
			}
		}
		if(array_filter($erori)){
			//daca am avea erori...
		}
		else{
			//cand nu avem erori

			$idAnimal = mysqli_real_escape_string($conexiune, $_POST['idAnimal']);
			$idAdapost = mysqli_real_escape_string($conexiune, $_POST['idAdapost']);

			// sql
			$sql = "INSERT INTO animal_adapost (idAnimal, idAdapost) VALUES ('$idAnimal', '$idAdapost')";			
			
			// salvare cu verificare in db
			if(mysqli_query($conexiune, $sql)){
				//succes
					
			}
			else{
				//eroare
				echo 'query error: ' . mysqli_error($conexiune);
			}

			//determinare nr locuri disponibile
			$sqlLocuri = "SELECT SUM(locuriDisponibile) as locD FROM adaposturi";
			$rezultate = mysqli_query($conexiune, $sqlLocuri);
			$locuri = array();
			if(mysqli_num_rows($rezultate) > 0){
				while($row = mysqli_fetch_assoc($rezultate)){
					$locuri[] = $row;
				}
			}
			//print_r($locuri[0]['locD']);

			
		}
	}

	$sql2 = 'SELECT idAdapost, tipAdapost, locuriDisponibile FROM adaposturi';

	// salvare rezultate
	$rezultate2 = mysqli_query($conexiune, $sql2);

	// transpunere rezultate intr-un array asociativ 
	$animal_adapost = mysqli_fetch_all($rezultate2, MYSQLI_ASSOC);

	//eliberare memorie
	mysqli_free_result($rezultate2);

	// inchidere conexiune
	mysqli_close($conexiune);

?>
<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>


	<section class="container grey-text text-darken-1">
		<h4 class="center">Plasare animăluț</h4>
		<form class="white" action= "plasare.php" method="POST">
			<div class="row">
        		<div class="input-field col s6">
          		<input type="text" name="idAnimal">
          		<label>id Animal</label>
          		<span class="helper-text">id-ul unui animal fara adapost</span>

        	</div>
        	<div class = "red-text col s6"><?php echo $erori['idAnimal']; ?></div>
        	<div class="row">
        		<div class="input-field col s6">
          		<input type="text" name="idAdapost">
          		<label>id Adapost</label>
          		<span class="helper-text">id-ul unui adapost disponibil</span>

        	</div>
        	<div class = "red-text col s6"><?php echo $erori['idAdapost']; ?></div>
			<br>
			<br>
			<div class="center col s12">
				<input id="butonPlaseaza" type="submit" name="submit" value="Plasează" class="btn brand z-depth-0">
			</div>
		</form>
		
	</section>
	<script>
		$(document).ready(function(){
			var loc = "<?php echo $locuri[0]['locD']; ?>";
			console.log(loc);
			if(loc<5)
				alert('Mai sunt doar ' + loc + ' locuri disponibile.');

		})
	</script>
<br>
<section class="container grey-text text-darken-1">
<h5 class = 'center grey-text text-darken-1'>Locuri disponibile</h5>
	<table class=" centered striped">
		<div class="responsive-table">
        <thead>
          <tr>
    
              <th>Id Adăpost</th>
              <th>Tip Adăpost</th>
              <th>Locuri Disponible</th>

          </tr>
        </thead>

        <tbody>
         	<?php foreach ($animal_adapost as $animalAdapost) { ?>
				<tr>
				
					<td><?php echo htmlspecialchars($animalAdapost['idAdapost']); ?></td>
					<td><?php echo htmlspecialchars($animalAdapost['tipAdapost']); ?></td>
					<td><?php echo htmlspecialchars($animalAdapost['locuriDisponibile']); ?></td>
				</tr>
			<?php } ?>
        </tbody>
        </div>
      </table>
</section>
	<?php include('templates/footer.php'); ?>

</html>