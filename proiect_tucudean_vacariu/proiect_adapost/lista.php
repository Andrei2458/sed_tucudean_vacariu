<?php

	include('config/db_connect.php');
	// comanda pentru vizualizarea clientilor
	$sql = 'SELECT * FROM clienti';

	// salvare rezultate
	$rezultate = mysqli_query($conexiune, $sql);

	// transpunere rezultate intr-un array asociativ -ala cu rezulta in el
	$clienti = mysqli_fetch_all($rezultate, MYSQLI_ASSOC);

	//eliberare memorie
	mysqli_free_result($rezultate);

	// inchidere conexiune
	mysqli_close($conexiune);

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>
	<section class="container grey-text text-darken-1">
	<h4 class = 'center grey-text text-darken-1'>Lista Eroi</h4>
	<table class=" centered striped">
		<div class="responsive-table">
        <thead>
          <tr>
              <th>Id Erou</th>
              <th>Nume Erou</th>
              <th>Numar Telefon</th>
              <th>Email</th>
              <th>Adresă</th>

          </tr>
        </thead>

        <tbody>
         	<?php foreach ($clienti as $client) { ?>
				<tr>
					<td><?php echo htmlspecialchars($client['idClient']); ?></td>
					<td><?php echo htmlspecialchars($client['numeClient']); ?></td>
					<td><?php echo htmlspecialchars($client['numarTelefon']); ?></td>
					<td><?php echo htmlspecialchars($client['email']); ?></td>
					<td><?php echo htmlspecialchars($client['adresa']); ?></td>
				</tr>
			<?php } ?>
        </tbody>
        </div>
      </table>
  	</section>

	<?php include('templates/footer.php'); ?>

</html>