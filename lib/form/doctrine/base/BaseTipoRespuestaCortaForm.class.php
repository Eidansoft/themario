<?php

/**
 * TipoRespuestaCorta form base class.
 *
 * @method TipoRespuestaCorta getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoRespuestaCortaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'respuesta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Respuesta'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'respuesta_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Respuesta'))),
    ));

    $this->widgetSchema->setNameFormat('tipo_respuesta_corta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRespuestaCorta';
  }

}
