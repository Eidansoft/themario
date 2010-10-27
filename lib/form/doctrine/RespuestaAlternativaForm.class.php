<?php

/**
 * RespuestaAlternativa form.
 *
 * @package    themario
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RespuestaAlternativaForm extends BaseRespuestaAlternativaForm
{
    function __construct($cuestion_id) {
        $this->cuestion_id = $cuestion_id;     
        parent::__construct();
    }
    
  public function configure()
  {
        unset(
                $this['tipoRespuestaAlternativa_id'],
                $this['respuestaElegida_id']
            );
    
        //Obtengo el objeto cuestion
        $cuestion = Doctrine_Core::getTable('Cuestion')->find($this->cuestion_id);
        
        $this->widgetSchema[$cuestion->getCuestionario_id().'-'.$this->cuestion_id] = new sfWidgetFormChoice(array('choices'  => Doctrine_Core::getTable('TipoPreguntaAlternativa')->getArrayRespuestasDeCuestion($this->cuestion_id),
                                                                    'expanded' => true,
        ));
        $this->validatorSchema[$cuestion->getCuestionario_id().'-'.$this->cuestion_id] = new sfValidatorNumber();
  }
  
  public static function getRespuestaRellena($respuesta, $cuestion_id, $parametrosRecibidos)
  {
        $tipo = new TipoRespuestaAlternativa();
        $tipo->setRespuesta($respuesta);
        
        $respuestaConcreta = new RespuestaAlternativa();
        $respuestaConcreta->setTipoRespuestaAlternativa($tipo);
        $respuestaConcreta->setRespuestaelegida_id($parametrosRecibidos[$parametrosRecibidos['cuestionario_id'].'-'.$cuestion_id]);
        $tipo->save();
        $respuestaConcreta->save();
  }
}
