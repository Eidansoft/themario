<?php

/**
 * ContenidoTipoCuestionario filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContenidoTipoCuestionarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contenido_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contenido'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'contenido_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contenido'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('contenido_tipo_cuestionario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContenidoTipoCuestionario';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'contenido_id' => 'ForeignKey',
    );
  }
}
