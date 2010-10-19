<h1><?php echo $titulo ?></h1>
<?php echo $comentario ?>


<?php slot('menu') ?>
<ul>
    <?php foreach ($cursos as $curso): ?>
    <li><a href="<?php echo $curso['url'] ?>"><?php echo $curso['texto'] ?></a></li>
        <?php if ($curso['actual']){ ?>
            <ul>
            <?php foreach ($temas as $tema): ?>
            <li><a href="<?php echo $tema['url'] ?>"><?php echo $tema['texto'] ?></a></li>
                <?php if ($tema['actual']){ ?>
                    <ul>
                    <?php foreach ($contenidos as $contenido): ?>
                    <li><a href="<?php echo $contenido['url'] ?>"><?php echo $contenido['texto'] ?></a></li>
                    
                    <?php endforeach; ?>
                    </ul>
                <?php } ?>
            <?php endforeach; ?>
            </ul>
        <?php } ?>
    <?php endforeach; ?>
</ul>
<?php end_slot() ?>

