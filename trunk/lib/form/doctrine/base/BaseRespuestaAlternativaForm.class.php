<?php

/**
 * RespuestaAlternativa form base class.
 *
 * @method RespuestaAlternativa getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRespuestaAlternativaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'tipoRespuestaAlternativa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuestaAlternativa'), 'add_empty' => false)),
      'respuestaElegida_id'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipoRespuestaAlternativa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuestaAlternativa'))),
      'respuestaElegida_id'         => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('respuesta_alternativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RespuestaAlternativa';
  }

}
