<?php

/**
 * TipoPreguntaAlternativa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    themario
 * @subpackage model
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class TipoPreguntaAlternativa extends BaseTipoPreguntaAlternativa
{
    public static function getFormularioRespuesta($cuestion_id)
    {
        return new RespuestaAlternativaForm($cuestion_id);
    }
}