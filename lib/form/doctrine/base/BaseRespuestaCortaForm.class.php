<?php

/**
 * RespuestaCorta form base class.
 *
 * @method RespuestaCorta getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRespuestaCortaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'tipoRespuestaCorta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuestaCorta'), 'add_empty' => false)),
      'texto'                 => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipoRespuestaCorta_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuestaCorta'))),
      'texto'                 => new sfValidatorString(array('max_length' => 500, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('respuesta_corta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RespuestaCorta';
  }

}
