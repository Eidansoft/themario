<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RespuestaCorta', 'doctrine');

/**
 * BaseRespuestaCorta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $cuestion_id
 * @property string $texto
 * @property Cuestion $Cuestion
 * 
 * @method integer        getId()          Returns the current record's "id" value
 * @method integer        getCuestionId()  Returns the current record's "cuestion_id" value
 * @method string         getTexto()       Returns the current record's "texto" value
 * @method Cuestion       getCuestion()    Returns the current record's "Cuestion" value
 * @method RespuestaCorta setId()          Sets the current record's "id" value
 * @method RespuestaCorta setCuestionId()  Sets the current record's "cuestion_id" value
 * @method RespuestaCorta setTexto()       Sets the current record's "texto" value
 * @method RespuestaCorta setCuestion()    Sets the current record's "Cuestion" value
 * 
 * @package    themario
 * @subpackage model
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRespuestaCorta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('respuestaCorta');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('cuestion_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('texto', 'string', 500, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 500,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cuestion', array(
             'local' => 'cuestion_id',
             'foreign' => 'id'));
    }
}