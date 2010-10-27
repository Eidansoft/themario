<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RespuestaAlternativa', 'doctrine');

/**
 * BaseRespuestaAlternativa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $tipoRespuestaAlternativa_id
 * @property integer $respuestaElegida_id
 * @property TipoRespuestaAlternativa $TipoRespuestaAlternativa
 * 
 * @method integer                  getId()                          Returns the current record's "id" value
 * @method integer                  getTipoRespuestaAlternativaId()  Returns the current record's "tipoRespuestaAlternativa_id" value
 * @method integer                  getRespuestaElegidaId()          Returns the current record's "respuestaElegida_id" value
 * @method TipoRespuestaAlternativa getTipoRespuestaAlternativa()    Returns the current record's "TipoRespuestaAlternativa" value
 * @method RespuestaAlternativa     setId()                          Sets the current record's "id" value
 * @method RespuestaAlternativa     setTipoRespuestaAlternativaId()  Sets the current record's "tipoRespuestaAlternativa_id" value
 * @method RespuestaAlternativa     setRespuestaElegidaId()          Sets the current record's "respuestaElegida_id" value
 * @method RespuestaAlternativa     setTipoRespuestaAlternativa()    Sets the current record's "TipoRespuestaAlternativa" value
 * 
 * @package    themario
 * @subpackage model
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRespuestaAlternativa extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('respuestaAlternativa');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('tipoRespuestaAlternativa_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('respuestaElegida_id', 'integer', 4, array(
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
        $this->hasOne('TipoRespuestaAlternativa', array(
             'local' => 'tipoRespuestaAlternativa_id',
             'foreign' => 'id'));
    }
}