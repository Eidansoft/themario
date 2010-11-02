<h1>Lista de los Temas</h1>

<table>
  <thead>
    <tr>
      <th>Ver</th>
      <th>Nombre</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($temas as $tema): ?>
    <tr>
      <td><a href="<?php echo url_for('tema/show?id='.$tema->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><a href="<?php echo url_for('contenido/ContenidosTema?tema_id='.$tema->getId()) ?>"><?php echo $tema->getNombre() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar los cursos</a></li>
    <li><a href="<?php echo url_for('tema/new'.(isset($curso_id)?'?curso_id='.$curso_id:'')) ?>">Nuevo tema</a></li>
<?php end_slot() ?>

