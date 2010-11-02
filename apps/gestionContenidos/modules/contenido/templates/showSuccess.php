<h1>Datos del contenido</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $contenido->getId() ?></td>
    </tr>
    <tr>
      <th>Titulo:</th>
      <td><?php echo $contenido->getTitulo() ?></td>
    </tr>
    <tr>
      <th>Tema:</th>
      <td><?php echo $contenido->getTemaId() ?></td>
    </tr>
    <tr>
      <th>Orden:</th>
      <td><?php echo $contenido->getOrden() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('contenido/edit?id='.$contenido->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('contenido/contenidosTema?tema_id='.$contenido->getTemaId()) ?>">Listar contenidos</a></li>
<?php end_slot() ?>

