<?php

/**
 * RespuestaAlternativa filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRespuestaAlternativaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cuestion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestion'), 'add_empty' => true)),
      'texto'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'cuestion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cuestion'), 'column' => 'id')),
      'texto'       => new sfValidatorPass(array('required' => false)),
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
      'id'          => 'Number',
      'cuestion_id' => 'ForeignKey',
      'texto'       => 'Text',
    );
  }
}
