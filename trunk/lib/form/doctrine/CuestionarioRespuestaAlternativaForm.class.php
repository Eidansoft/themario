<?php

/**
 * RespuestaAlternativa form.
 *
 * @package    themario
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CuestionarioRespuestaAlternativaForm extends BaseRespuestaAlternativaForm
{
    function __construct($cuestion_id, $otroForm = NULL) {
        $this->cuestion_id = $cuestion_id;
        $this->otroForm = $otroForm;        
        parent::__construct();
    }
    
    public function configure()
    {
        //if ($this->otroForm != NULL){
            $this->mergeform($this->otroForm);
        //}
        
        unset(
            $this['cuestion_id']
        );
        
        $this->widgetSchema['texto'] = new sfWidgetFormChoice(array('choices'  => Doctrine_Core::getTable('RespuestaAlternativa')->getArrayRespuestasDeCuestion($this->cuestion_id),
                                                                    'expanded' => true,
        ));
        
        
    }
}
