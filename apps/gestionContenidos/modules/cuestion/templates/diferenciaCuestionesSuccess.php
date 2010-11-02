<h1>Selecci&oacute;n de tipo de Respuestas</h1>

<p>A&uacute;n no se ha definido el tipo de respuesta de la cuesti&oacute;n. Selecciona el tipo para crearlo:</p>
<ul>
    <li><a href="<?php echo url_for('tipoPreguntaAlternativa/new'.(isset($cuestion_id)?'?cuestion_id='.$cuestion_id:'')) ?>">Respuestas alternativas</a></li>
    <li><a href="<?php echo url_for('tipoPreguntaCorta/new'.(isset($cuestion_id)?'?cuestion_id='.$cuestion_id:'')) ?>">Respuesta corta</a></li>
</ul>

<?php slot('menu') ?>
    <li><a href="javascript:history.back(1)">Cancelar</a></li>
<?php end_slot() ?>

