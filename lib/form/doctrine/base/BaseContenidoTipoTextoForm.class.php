<?php

/**
 * ContenidoTipoTexto form base class.
 *
 * @method ContenidoTipoTexto getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContenidoTipoTextoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'texto'        => new sfWidgetFormTextarea(),
      'contenido_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contenido'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'texto'        => new sfValidatorString(array('required' => false)),
      'contenido_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contenido'))),
    ));

    $this->widgetSchema->setNameFormat('contenido_tipo_texto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContenidoTipoTexto';
  }

}
