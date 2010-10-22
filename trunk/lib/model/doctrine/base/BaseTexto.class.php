<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Texto', 'doctrine');

/**
 * BaseTexto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $texto
 * @property integer $contenido_id
 * @property Contenido $Contenido
 * 
 * @method integer   getId()           Returns the current record's "id" value
 * @method string    getTexto()        Returns the current record's "texto" value
 * @method integer   getContenidoId()  Returns the current record's "contenido_id" value
 * @method Contenido getContenido()    Returns the current record's "Contenido" value
 * @method Texto     setId()           Sets the current record's "id" value
 * @method Texto     setTexto()        Sets the current record's "texto" value
 * @method Texto     setContenidoId()  Sets the current record's "contenido_id" value
 * @method Texto     setContenido()    Sets the current record's "Contenido" value
 * 
 * @package    themario
 * @subpackage model
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTexto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('texto');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('texto', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
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
    }
}