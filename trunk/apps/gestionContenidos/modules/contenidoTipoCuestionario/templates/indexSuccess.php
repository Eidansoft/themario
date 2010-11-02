<h1>Cuestionarios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Contenido</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contenido_tipo_cuestionarios as $cuestionario): ?>
    <tr>
      <td><a href="<?php echo url_for('contenidoTipoCuestionario/show?id='.$cuestionario->getId()) ?>"><?php echo $cuestionario->getId() ?></a></td>
      <td><?php echo $cuestionario->getContenidoId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('contenidoTipoCuestionario/new') ?>">New</a>
