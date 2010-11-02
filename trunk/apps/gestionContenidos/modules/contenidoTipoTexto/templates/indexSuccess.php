<h1>Texto</h1>

<table>
  <thead>
    <tr>
      <th>Ver</th>
      <th>Texto</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sf_data->getRaw('textos') as $texto): ?>
    <tr>
      <td><a href="<?php echo url_for('contenidoTipoTexto/show?id='.$texto->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><?php echo $texto->getTexto() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar los cursos</a></li>
    <li><a href="<?php echo url_for('tema/TemasCurso?curso_id='.$curso_id) ?>">Listar los temas</a></li>
    <li><a href="<?php echo url_for('contenido/ContenidosTema?tema_id='.$tema_id) ?>">Listar los contenidos</a></li>
<?php end_slot() ?>

