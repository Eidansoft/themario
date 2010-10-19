<?php

/**
 * Texto filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTextoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'texto'        => new sfWidgetFormFilterInput(),
      'contenido_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contenido'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'texto'        => new sfValidatorPass(array('required' => false)),
      'contenido_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contenido'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('texto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Texto';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'texto'        => 'Text',
      'contenido_id' => 'ForeignKey',
    );
  }
}
