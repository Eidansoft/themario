<h1>Selecci&oacute;n de tipo de Contenido</h1>

<p>A&uacute;n no se ha definido el tipo de este contenido. Selecciona el tipo para crearlo:</p>
<ul>
    <li><a href="<?php echo url_for('contenidoTipoTexto/new'.(isset($contenido_id)?'?contenido_id='.$contenido_id:'')) ?>">Texto</a></li>
    <li><a href="<?php echo url_for('contenidoTipoCuestionario/new'.(isset($contenido_id)?'?contenido_id='.$contenido_id:'')) ?>">Cuestionario</a></li>
</ul>

<?php slot('menu') ?>
    <li><a href="javascript:history.back(1)">Cancelar</a></li>
<?php end_slot() ?>

