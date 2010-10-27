<?php

/**
 * CuestionAlumnoRespuesta filter form base class.
 *
 * @package    themario
 * @subpackage filter
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCuestionAlumnoRespuestaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cuestion_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestion'), 'add_empty' => true)),
      'respuesta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Respuesta'), 'add_empty' => true)),
      'alumno_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Alumno'), 'add_empty' => true)),
      'fecha'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'cuestion_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cuestion'), 'column' => 'id')),
      'respuesta_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Respuesta'), 'column' => 'id')),
      'alumno_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Alumno'), 'column' => 'id')),
      'fecha'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cuestion_alumno_respuesta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CuestionAlumnoRespuesta';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'cuestion_id'  => 'ForeignKey',
      'respuesta_id' => 'ForeignKey',
      'alumno_id'    => 'ForeignKey',
      'fecha'        => 'Date',
    );
  }
}
