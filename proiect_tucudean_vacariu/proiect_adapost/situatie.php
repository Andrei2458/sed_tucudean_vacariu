<?php

	include('config/db_connect.php');
	// comanda pentru vizualizare relatie animal-adapost
	$sql = 'SELECT aa.idAnimalAdapost, ad.idAdapost, ad.tipAdapost, ad.locuriDisponibile, an.idAnimal, an.tip_animal, an.nume FROM animale an JOIN animal_adapost aa ON an.idAnimal = aa.idAnimal JOIN adaposturi ad ON ad.idAdapost = aa.idAdapost WHERE aa.dataAdoptie is NULL ORDER BY an.idAnimal ASC';

	// salvare rezultate
	$rezultate = mysqli_query($conexiune, $sql);

	// transpunere rezultate intr-un array asociativ -ala cu rezulta in el
	$animal_adapost = mysqli_fetch_all($rezultate, MYSQLI_ASSOC);

	//eliberare memorie
	mysqli_free_result($rezultate);

	// inchidere conexiune
	mysqli_close($conexiune);

	//print_r($animal_adapost);

	//extrage info utile
	//extrage info legat de adapost
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>
	<section class="container grey-text text-darken-1">
	<h4 class = 'center grey-text text-darken-1'>Situație adăpost</h4>
	<table class=" centered striped">
		<div class="responsive-table">
        <thead>
          <tr>
     
              <th>Id Animal</th>
              <th>Tip Animal</th>
              <th>Nume</th>
              <th>Id Adăpost</th>
              <th>Tip Adăpost</th>
              <th>Locuri Disponible</th>

          </tr>
        </thead>

        <tbody>
         	<?php foreach ($animal_adapost as $animalAdapost) { ?>
				<tr>
					<td><?php echo htmlspecialchars($animalAdapost['idAnimal']); ?></td>
					<td><?php echo htmlspecialchars($animalAdapost['tip_animal']); ?></td>
					<td><?php echo htmlspecialchars($animalAdapost['nume']); ?></td>
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