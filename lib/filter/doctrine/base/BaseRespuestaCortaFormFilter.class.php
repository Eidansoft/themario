<?php

/**
 * RespuestaCorta filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRespuestaCortaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipoRespuestaCorta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuestaCorta'), 'add_empty' => true)),
      'texto'                 => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tipoRespuestaCorta_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoRespuestaCorta'), 'column' => 'id')),
      'texto'                 => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('respuesta_corta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RespuestaCorta';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'tipoRespuestaCorta_id' => 'ForeignKey',
      'texto'                 => 'Text',
    );
  }
}
