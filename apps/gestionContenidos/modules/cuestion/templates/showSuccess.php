<h1>Datos de la cuesti&oacute;n o pregunta</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $cuestion->getId() ?></td>
    </tr>
    <tr>
      <th>Pregunta:</th>
      <td><?php echo $cuestion->getPregunta() ?></td>
    </tr>
    <tr>
      <th>Cuestionario:</th>
      <td><?php echo $cuestion->getCuestionarioId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('cuestion/edit?id='.$cuestion->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('cuestion/cuestionesCuestionario?cuestionario_id='.$cuestion->getCuestionarioId()) ?>">Volver a las cuestiones</a></li>
<?php end_slot() ?>

