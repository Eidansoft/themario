<h1><?php echo $titulo ?></h1>

<?php include_partial('form', array('form' => $form)) ?>


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
