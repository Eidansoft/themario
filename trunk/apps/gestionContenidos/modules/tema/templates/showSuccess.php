<h1>Datos del tema</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $tema->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $tema->getNombre() ?></td>
    </tr>
    <tr>
      <th>Curso:</th>
      <td><?php echo $tema->getCursoId() ?></td>
    </tr>
  </tbody>
</table>

<hr />


<?php slot('menu') ?>
    <li><a href="<?php echo url_for('tema/edit?id='.$tema->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('tema/temasCurso?curso_id='.$tema->getCursoId()) ?>">Listar temas</a></li>
<?php end_slot() ?>

