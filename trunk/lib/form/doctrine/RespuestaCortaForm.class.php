<?php

/**
 * RespuestaCorta form.
 *
 * @package    themario
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RespuestaCortaForm extends BaseRespuestaCortaForm
{
    function __construct($cuestion_id) {
        $this->cuestion_id = $cuestion_id;
        parent::__construct();
    }
    
  public function configure()
  {
        unset(
            $this['tipoRespuestaCorta_id'],
            $this['texto']
        );
        
        //Obtengo el objeto cuestion
        $cuestion = Doctrine_Core::getTable('Cuestion')->find($this->cuestion_id);
        
        //$this->widgetSchema['tipoRespuestaCorta_id-'.$this->cuestion_id] = new sfWidgetFormInputHidden();
        $this->widgetSchema[$cuestion->getCuestionario_id().'-'.$this->cuestion_id] = new sfWidgetFormInput();
        
        //$this->validatorSchema['tipoRespuestaCorta_id-'.$this->cuestion_id] = new sfValidatorNumber();
        $this->validatorSchema[$cuestion->getCuestionario_id().'-'.$this->cuestion_id] = new sfValidatorString(array('max_length' => 255));
  }
  
  public static function getRespuestaRellena($respuesta, $cuestion_id, $parametrosRecibidos)
  {
        $tipo = new TipoRespuestaCorta();
        $tipo->setRespuesta($respuesta);
        
        $respuestaConcreta = new RespuestaCorta();
        $respuestaConcreta->setTipoRespuestaCorta($tipo);
        $respuestaConcreta->setTexto($parametrosRecibidos[$parametrosRecibidos['cuestionario_id'].'-'.$cuestion_id]);
        $tipo->save();
        $respuestaConcreta->save();
  }
}
