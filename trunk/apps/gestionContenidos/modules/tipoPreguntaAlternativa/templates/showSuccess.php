<h1>Datos de la Respuesta alternativa</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $respuesta_alternativa->getId() ?></td>
    </tr>
    <tr>
      <th>Cuestion:</th>
      <td><?php echo $respuesta_alternativa->getCuestionId() ?></td>
    </tr>
    <tr>
      <th>Texto:</th>
      <td><?php echo $respuesta_alternativa->getTexto() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('respuestaAlternativa/edit?id='.$respuesta_alternativa->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('respuestaAlternativa/respuestaCuestion?cuestion_id='.$respuesta_alternativa->getCuestionId()) ?>">Volver a las respuestas</a></li>
<?php end_slot() ?>

