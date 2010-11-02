<?php

/**
 * CuestionarioGenerico form.
 *
 * @package    themario
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CuestionarioGenericoForm extends BaseContenidoTipoCuestionarioForm
{
    function __construct($cuestionario_id) {
        $this->cuestionario_id = $cuestionario_id;
        parent::__construct();
    }
    
    public function configure()
    {
        unset(
            $this['contenido_id']
        );
        
        //$this->widgetSchema['cuestionario_id'] = new sfWidgetFormInput(array(), array(
		//		                                                                'value' => $this->cuestionario_id,
		//		                                                                'readonly' => 'readonly'
		//		                                                                ));
		$this->widgetSchema['cuestionario_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['cuestionario_id'] = new sfValidatorNumber();
    }
}
