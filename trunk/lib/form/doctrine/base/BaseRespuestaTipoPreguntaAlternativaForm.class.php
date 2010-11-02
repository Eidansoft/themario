<?php

/**
 * RespuestaTipoPreguntaAlternativa form base class.
 *
 * @method RespuestaTipoPreguntaAlternativa getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRespuestaTipoPreguntaAlternativaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'tipoPreguntaAlternativa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPreguntaAlternativa'), 'add_empty' => false)),
      'texto'                      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipoPreguntaAlternativa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPreguntaAlternativa'))),
      'texto'                      => new sfValidatorString(array('max_length' => 500)),
    ));

    $this->widgetSchema->setNameFormat('respuesta_tipo_pregunta_alternativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RespuestaTipoPreguntaAlternativa';
  }

}
