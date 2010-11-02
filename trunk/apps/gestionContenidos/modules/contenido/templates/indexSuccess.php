<h1>Lista de los Contenidos</h1>

<table>
  <thead>
    <tr>
      <th>Ver</th>
      <th>Titulo</th>
      <th>Orden</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contenidos as $contenido): ?>
    <tr>
      <td><a href="<?php echo url_for('contenido/show?id='.$contenido->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><a href="<?php echo url_for('contenido/diferenciaContenidos?contenido_id='.$contenido->getId()) ?>"><?php echo $contenido->getTitulo() ?></a></td>
      <td><?php echo $contenido->getOrden() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar los cursos</a></li>
    <li><a href="<?php echo url_for('tema/temasCurso?curso_id='.$curso_id) ?>">Listar los temas</a></li>
    <li><a href="<?php echo url_for('contenido/new'.(isset($tema_id)?'?tema_id='.$tema_id:'')) ?>">Nuevo contenido</a></li>
<?php end_slot() ?>

