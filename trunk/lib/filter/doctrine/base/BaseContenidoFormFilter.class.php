<?php

/**
 * Contenido filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContenidoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tema_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tema'), 'add_empty' => true)),
      'orden'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'titulo'  => new sfValidatorPass(array('required' => false)),
      'tema_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tema'), 'column' => 'id')),
      'orden'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contenido_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contenido';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'titulo'  => 'Text',
      'tema_id' => 'ForeignKey',
      'orden'   => 'Number',
    );
  }
}
