<?php

/**
 * RespuestaTipoPreguntaAlternativa filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRespuestaTipoPreguntaAlternativaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipoPreguntaAlternativa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPreguntaAlternativa'), 'add_empty' => true)),
      'texto'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'tipoPreguntaAlternativa_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoPreguntaAlternativa'), 'column' => 'id')),
      'texto'                      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('respuesta_tipo_pregunta_alternativa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RespuestaTipoPreguntaAlternativa';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'tipoPreguntaAlternativa_id' => 'ForeignKey',
      'texto'                      => 'Text',
    );
  }
}
