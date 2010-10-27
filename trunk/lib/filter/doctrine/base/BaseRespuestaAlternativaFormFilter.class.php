<?php

/**
 * RespuestaAlternativa filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRespuestaAlternativaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipoRespuestaAlternativa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuestaAlternativa'), 'add_empty' => true)),
      'respuestaElegida_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'tipoRespuestaAlternativa_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoRespuestaAlternativa'), 'column' => 'id')),
      'respuestaElegida_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('respuesta_alternativa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RespuestaAlternativa';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'tipoRespuestaAlternativa_id' => 'ForeignKey',
      'respuestaElegida_id'         => 'Number',
    );
  }
}
