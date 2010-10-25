<fieldset>
<h2><?php echo $cuestion['pregunta'] ?></h2>


    <?php foreach ($cuestion['respuestas'] as $objetoRespuesta): ?>
        <input type="radio" name="__<?php echo $cuestion['cuestion'] ?>" id="__<?php echo $cuestion['cuestion'].'.'.$objetoRespuesta->getId() ?>" />
        <label for="__<?php echo $cuestion['cuestion'].'.'.$objetoRespuesta->getId() ?>" ><?php echo $objetoRespuesta->getTexto(); ?></label>
    <?php endforeach; ?>
</fieldset>
