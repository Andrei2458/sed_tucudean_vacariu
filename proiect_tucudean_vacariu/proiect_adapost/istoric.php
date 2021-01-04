<?php

	include('config/db_connect.php');
	// comanda pentru vizualizare relatie animal-adapost
	$sql = 'SELECT c.idClient, c.numeClient, an.idAnimal, an.tip_animal, an.nume FROM clienti c JOIN adoptii ad ON c.idClient=ad.idClient JOIN animale an ON an.idAnimal = ad.idAnimal';

	// salvare rezultate
	$rezultate = mysqli_query($conexiune, $sql);

	// transpunere rezultate intr-un array asociativ -ala cu rezulta in el
	$adoptii = mysqli_fetch_all($rezultate, MYSQLI_ASSOC);

	//eliberare memorie
	mysqli_free_result($rezultate);

	// inchidere conexiune
	mysqli_close($conexiune);

	
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>
	<section class="container grey-text text-darken-1">
	<h4 class = 'center grey-text text-darken-1'>Istoric Adopții</h4>
	<table class=" centered striped">
		<div class="responsive-table">
        <thead>
          <tr>
              <th>Id Erou</th>
              <th>Nume Erou</th>
              <th>Id Animăluț</th>
              <th>Tip Animăluț</th>
              <th>Nume Animăluț</th>

          </tr>
        </thead>

        <tbody>
         	<?php foreach ($adoptii as $adoptie) { ?>
				<tr>
					<td><?php echo htmlspecialchars($adoptie['idClient']); ?></td>
					<td><?php echo htmlspecialchars($adoptie['numeClient']); ?></td>
					<td><?php echo htmlspecialchars($adoptie['idAnimal']); ?></td>
					<td><?php echo htmlspecialchars($adoptie['tip_animal']); ?></td>
					<td><?php echo htmlspecialchars($adoptie['nume']); ?></td>
				</tr>
			<?php } ?>
        </tbody>
        </div>
      </table>
  	</section>

	<?php include('templates/footer.php'); ?>

</html>