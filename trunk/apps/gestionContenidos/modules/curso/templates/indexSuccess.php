<h1>Lista de los cursos</h1>

<table>
  <thead>
    <tr>
      <th>Ver</th>
      <th>Nombre del curso</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cursos as $curso): ?>
    <tr>
      <td><a href="<?php echo url_for('curso/show?id='.$curso->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><a href="<?php echo url_for('tema/TemasCurso?curso_id='.$curso->getId()) ?>"><?php echo $curso->getNombre() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
  
<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/new') ?>">Nuevo curso</a></li>
<?php end_slot() ?>

