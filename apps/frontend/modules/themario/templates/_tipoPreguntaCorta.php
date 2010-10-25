<fieldset>
<h2><?php echo $cuestion['pregunta'] ?></h2>

    <?php foreach ($cuestion['respuestas'] as $objetoRespuesta): ?>
        <label for="__<?php echo $cuestion['cuestion'].'.'.$objetoRespuesta->getId() ?>" >Respuesta:</label>
        <input type="text" name="__<?php echo $cuestion['cuestion'] ?>" id="__<?php echo $cuestion['cuestion'].'.'.$objetoRespuesta->getId() ?>" value="<?php echo $objetoRespuesta->getTexto(); ?>" />
    <?php endforeach; ?>
</fieldset>
