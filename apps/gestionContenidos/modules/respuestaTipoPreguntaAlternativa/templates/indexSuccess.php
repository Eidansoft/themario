<h1>Respuesta tipo pregunta alternativas List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Tipo pregunta alternativa</th>
      <th>Texto</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta_tipo_pregunta_alternativas as $respuesta_tipo_pregunta_alternativa): ?>
    <tr>
      <td><a href="<?php echo url_for('respuestaTipoPreguntaAlternativa/show?id='.$respuesta_tipo_pregunta_alternativa->getId()) ?>"><span class"verLink">Ver</span></a></td>
      <td><?php echo $respuesta_tipo_pregunta_alternativa->getTipopreguntaalternativaId() ?></td>
      <td><?php echo $respuesta_tipo_pregunta_alternativa->getTexto() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
  
<?php slot('menu') ?>
    <li><a href="<?php echo url_for('curso/index') ?>">Listar los cursos</a></li>
    <li><a href="<?php echo url_for('tema/TemasCurso?curso_id='.$curso_id) ?>">Listar los temas</a></li>
    <li><a href="<?php echo url_for('contenido/ContenidosTema?tema_id='.$tema_id) ?>">Listar los contenidos</a></li>
    <li><a href="<?php echo url_for('cuestion/cuestionesCuestionario?cuestionario_id='.$cuestionario_id) ?>">Listar las cuestiones</a></li>
    <li><a href="<?php echo url_for('respuestaTipoPreguntaAlternativa/new'.(isset($tipoPregunta_id)?'?tipoPregunta_id='.$tipoPregunta_id:'')) ?>">Nueva respuesta alternativa</a></li>
<?php end_slot() ?>
