<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $respuesta_tipo_pregunta_alternativa->getId() ?></td>
    </tr>
    <tr>
      <th>Tipo pregunta alternativa:</th>
      <td><?php echo $respuesta_tipo_pregunta_alternativa->getTipopreguntaalternativaId() ?></td>
    </tr>
    <tr>
      <th>Texto:</th>
      <td><?php echo $respuesta_tipo_pregunta_alternativa->getTexto() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('respuestaTipoPreguntaAlternativa/edit?id='.$respuesta_tipo_pregunta_alternativa->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('respuestaTipoPreguntaAlternativa/respuestaCuestion?tipoPregunta_id='.$respuesta_tipo_pregunta_alternativa->getTipopreguntaalternativaId()) ?>">Volver a las respuestas</a></li>
<?php end_slot() ?>
