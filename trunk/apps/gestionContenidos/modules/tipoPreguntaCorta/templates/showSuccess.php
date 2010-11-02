<h1>Datos de la respuesta</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $tipo_pregunta_corta->getId() ?></td>
    </tr>
    <tr>
      <th>Cuestion:</th>
      <td><?php echo $tipo_pregunta_corta->getCuestionId() ?></td>
    </tr>
    <tr>
      <th>Texto:</th>
      <td><?php echo $tipo_pregunta_corta->getTexto() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('tipoPreguntaCorta/edit?id='.$tipo_pregunta_corta->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('tipoPreguntaCorta/respuestaCuestion?cuestion_id='.$tipo_pregunta_corta->getCuestionId()) ?>">Volver a la respuesta</a></li>
<?php end_slot() ?>

