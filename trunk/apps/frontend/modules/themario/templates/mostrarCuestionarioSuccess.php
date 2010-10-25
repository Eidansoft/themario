<h1><?php echo $titulo ?></h1>

<form action="<?php echo url_for('themario/solucionCuestionario?id='.$cuestionario_id) ?>" type="post">
<?php foreach ($sf_data->getRaw('cuestiones') as $cuestion): ?>
    <?php include '_'.$cuestion['tipo'].'.php' ?>
<?php endforeach; ?>
<input type="submit" value="Enviar" /><input type="reset" value="Limpiar" />
</form>





<?php slot('menu') ?>
<ul>
    <?php foreach ($cursos as $curso): ?>
    <li><a href="<?php echo $curso['url'] ?>"><?php echo $curso['texto'] ?></a></li>
        <?php if ($curso['actual']){ ?>
            <ol>
            <?php foreach ($temas as $tema): ?>
            <li><a href="<?php echo $tema['url'] ?>"><?php echo $tema['texto'] ?></a></li>
                <?php if ($tema['actual']){ ?>
                    <ol>
                    <?php foreach ($contenidos as $contenido): ?>
                    <li><a href="<?php echo $contenido['url'] ?>"><?php echo $contenido['texto'] ?></a></li>
                    
                    <?php endforeach; ?>
                    </ol>
                <?php } ?>
            <?php endforeach; ?>
            </ol>
        <?php } ?>
    <?php endforeach; ?>
</ul>
<?php end_slot() ?>

