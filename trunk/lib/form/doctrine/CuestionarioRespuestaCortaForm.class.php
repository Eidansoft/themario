<?php

/**
 * RespuestaCorta form.
 *
 * @package    themario
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CuestionarioRespuestaCortaForm extends BaseRespuestaCortaForm
{
    public function configure()
    {
        unset(
            $this['cuestion_id']
        );

    }
}
