<?php

/**
 * TipoRespuestaAlternativa filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipoRespuestaAlternativaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'respuesta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Respuesta'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'respuesta_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Respuesta'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tipo_respuesta_alternativa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRespuestaAlternativa';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'respuesta_id' => 'ForeignKey',
    );
  }
}
