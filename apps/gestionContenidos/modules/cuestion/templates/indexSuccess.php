<h1>Cuestiones</h1>

<table>
  <thead>
    <tr>
      <th>Ver</th>
      <th>Pregunta</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cuestions as $cuestion): ?>
    <tr>
      <td><a href="<?php echo url_for('cuestion/show?id='.$cuestion->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><a href="<?php echo url_for('cuestion/diferenciaCuestiones?cuestion_id='.$cuestion->getId()) ?>"><?php echo $cuestion->getPregunta() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar los cursos</a></li>
    <li><a href="<?php echo url_for('tema/TemasCurso?curso_id='.$curso_id) ?>">Listar los temas</a></li>
    <li><a href="<?php echo url_for('contenido/ContenidosTema?tema_id='.$tema_id) ?>">Listar los contenidos</a></li>
    <li><a href="<?php echo url_for('cuestion/new'.(isset($cuestionario_id)?'?cuestionario_id='.$cuestionario_id:'')) ?>">Nueva cuesti&oacute;n</a></li>
<?php end_slot() ?>

