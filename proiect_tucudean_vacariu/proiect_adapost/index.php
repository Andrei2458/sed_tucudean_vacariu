<?php

	include('config/db_connect.php');

	$sql = 'SELECT an.idAnimal, an.tip_animal, an.rasa, an.culoare, an.varsta, an.sex, an.nume FROM animale an LEFT JOIN animal_adapost aa ON an.idAnimal=aa.idAnimal WHERE aa.dataAdoptie is NULL ORDER BY an.idAnimal ASC';
	
	// salvare rezultate
	$rezultate = mysqli_query($conexiune, $sql);

	// transpunere rezultate intr-un array asociativ -ala cu rezulta in el
	$animale = mysqli_fetch_all($rezultate, MYSQLI_ASSOC);

	// eliberare memorie
	mysqli_free_result($rezultate);

	// inchidere conexiune
	mysqli_close($conexiune);

	//print_r($animale);


?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>
	<h4 class = 'center grey-text'>Animăluțe înregistrate</h4>
	<div class="row">
		
					
		<?php foreach ($animale as $animal) { ?>
			<div class="col s4">
				<div class="card">		
					<div class="card-image">
						<img src="adapost-azorel.jpg">
							<span class="card-title grey-text text-darken-1"><?php echo htmlspecialchars($animal['idAnimal']) . '. ' . htmlspecialchars($animal['nume']); ?>
							</span>
					</div>
					<div class="card-content">
						<p>
							<?php echo 'Mă numesc ' . htmlspecialchars($animal['nume']) . ' și sunt ' .  htmlspecialchars($animal['tip_animal']) . ' în căutarea unui adăpost. Am ' . htmlspecialchars($animal['varsta']) . ' anișori, rasa mea este ' . htmlspecialchars($animal['rasa']) . ' și am culoare ' . htmlspecialchars($animal['culoare']) . '. Dacă mă placi, poți să mă iei acasă și să fim cei mai buni prieteni.'; ?>
						</p>			
								
					
					</div>
					
				</div>
			</div>

		<?php } ?>
				
					
	</div>

	
	<?php include('templates/footer.php'); ?>

</html>