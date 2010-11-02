<h1>Respuesta corta</h1>

<table>
  <thead>
    <tr>
      <th>Ver</th>
      <th>Texto por defecto</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><a href="<?php echo url_for('tipoPreguntaCorta/show?id='.$respuesta_corta->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><?php echo $respuesta_corta->getTexto() ?></td>
    </tr>
  </tbody>
</table>

<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar los cursos</a></li>
    <li><a href="<?php echo url_for('tema/TemasCurso?curso_id='.$curso_id) ?>">Listar los temas</a></li>
    <li><a href="<?php echo url_for('contenido/ContenidosTema?tema_id='.$tema_id) ?>">Listar los contenidos</a></li>
    <li><a href="<?php echo url_for('cuestion/cuestionesCuestionario?cuestionario_id='.$cuestionario_id) ?>">Listar las cuestiones</a></li>
<?php end_slot() ?>


