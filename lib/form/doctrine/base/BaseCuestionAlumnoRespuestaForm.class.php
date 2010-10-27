<?php

/**
 * CuestionAlumnoRespuesta form base class.
 *
 * @method CuestionAlumnoRespuesta getObject() Returns the current form's model object
 *
 * @package    themario
 * @subpackage form
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCuestionAlumnoRespuestaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'cuestion_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestion'), 'add_empty' => false)),
      'respuesta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Respuesta'), 'add_empty' => true)),
      'alumno_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumno'), 'add_empty' => false)),
      'fecha'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cuestion_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestion'))),
      'respuesta_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Respuesta'), 'required' => false)),
      'alumno_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Alumno'))),
      'fecha'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cuestion_alumno_respuesta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CuestionAlumnoRespuesta';
  }

}
