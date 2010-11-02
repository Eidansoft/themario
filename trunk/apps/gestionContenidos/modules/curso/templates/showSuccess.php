<h1>Datos del curso</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $curso->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $curso->getNombre() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/edit?id='.$curso->getId()) ?>">Modificar</a></li>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar cursos</a></li>
<?php end_slot() ?>

