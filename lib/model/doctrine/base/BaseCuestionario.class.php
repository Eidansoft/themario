<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Cuestionario', 'doctrine');

/**
 * BaseCuestionario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $contenido_id
 * @property Contenido $Contenido
 * @property Doctrine_Collection $Cuestion
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method integer             getContenidoId()  Returns the current record's "contenido_id" value
 * @method Contenido           getContenido()    Returns the current record's "Contenido" value
 * @method Doctrine_Collection getCuestion()     Returns the current record's "Cuestion" collection
 * @method Cuestionario        setId()           Sets the current record's "id" value
 * @method Cuestionario        setContenidoId()  Sets the current record's "contenido_id" value
 * @method Cuestionario        setContenido()    Sets the current record's "Contenido" value
 * @method Cuestionario        setCuestion()     Sets the current record's "Cuestion" collection
 * 
 * @package    themario
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCuestionario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cuestionario');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('contenido_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Contenido', array(
             'local' => 'contenido_id',
             'foreign' => 'id'));

        $this->hasMany('Cuestion', array(
             'local' => 'id',
             'foreign' => 'cuestionario_id'));
    }
}