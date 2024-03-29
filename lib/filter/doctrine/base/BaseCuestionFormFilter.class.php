<?php

/**
 * Cuestion filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCuestionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pregunta'        => new sfWidgetFormFilterInput(),
      'cuestionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContenidoTipoCuestionario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'pregunta'        => new sfValidatorPass(array('required' => false)),
      'cuestionario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContenidoTipoCuestionario'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('cuestion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cuestion';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'pregunta'        => 'Text',
      'cuestionario_id' => 'ForeignKey',
    );
  }
}
