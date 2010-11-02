<h1>Datos del texto</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $texto->getId() ?></td>
    </tr>
    <tr>
      <th>Texto:</th>
      <td><?php echo $texto->getTexto() ?></td>
    </tr>
    <tr>
      <th>Contenido:</th>
      <td><?php echo $texto->getContenidoId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('contenidoTipoTexto/edit?id='.$texto->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('contenidoTipoTexto/textosContenido?contenido_id='.$texto->getContenidoId()) ?>">Volver al texto</a></li>
<?php end_slot() ?>

