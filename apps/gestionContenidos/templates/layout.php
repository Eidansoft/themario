<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="menu">
        <div class="titulo">Men&uacute;</div>
        <ul>
            <?php include_slot('menu') ?>
        </ul>
    </div>
    
    <div id="pagina">
        <div id="barraNavegacion"><?php //include_slot('barraNavegacion') ?></div>
        <div id="contenido"</div>
            <?php echo $sf_content ?>
        </div>
    </div>
<?php
/*
    <div id="administracion">
        <div class="titulo">Administraci&oacute;n</div>
            <ul>
                <li><a href="<?php echo url_for('curso/index') ?>">Listar cursos</a></li>
                <li><a href="<?php echo url_for('tema/index') ?>">Listar Temas</a></li>
                <li><a href="<?php echo url_for('contenido/index') ?>">Listar Contenidos</a></li>
                <li><a href="<?php echo url_for('texto/index') ?>">Listar Textos</a></li>
                <li><a href="<?php echo url_for('cuestionario/index') ?>">Listar Cuestionarios</a></li>
                <li><a href="<?php echo url_for('cuestion/index') ?>">Listar Cuestiones</a></li>
                <li><a href="<?php echo url_for('respuestaAlternativa/index') ?>">Listar Respuestas alternativas</a></li>
                <li><a href="<?php echo url_for('respuestaCorta/index') ?>">Listar Respuestas cortas</a></li>
            </ul>
    </div>
*/
?>
  </body>
</html>
