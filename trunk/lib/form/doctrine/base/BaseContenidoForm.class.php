<?php

/**
 * Contenido form base class.
 *
 * @method Contenido getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContenidoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'titulo'  => new sfWidgetFormTextarea(),
      'tema_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tema'), 'add_empty' => false)),
      'orden'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'  => new sfValidatorString(array('max_length' => 500)),
      'tema_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tema'))),
      'orden'   => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('contenido[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contenido';
  }

}
