<?php

/**
 * TipoPreguntaCorta filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipoPreguntaCortaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cuestion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestion'), 'add_empty' => true)),
      'texto'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cuestion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cuestion'), 'column' => 'id')),
      'texto'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_pregunta_corta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoPreguntaCorta';
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
