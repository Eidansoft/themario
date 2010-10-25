<?php

/**
 * ContenidoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ContenidoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ContenidoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Contenido');
    }
    
    public function getContenidosDeTemaId($tema_id)
    {
        return Doctrine_Core::getTable('Contenido')->createQuery('a')->where('tema_id = ?', $tema_id)->execute();
    }
    
    public function getTipoContenido($contenido_id)
    {
        //consulto todas las tablas de mi esquema denominadas "contenidoTipo....."
        $pdo = Doctrine_Manager::connection()->getDbh();
        // disable constraint checking for mysql when innodb tables are used
        $pdo->exec('SET foreign_key_checks = 0');
        // get all tables
        $sql = "SELECT table_name
                FROM information_schema.tables
                WHERE table_schema = (SELECT schema() FROM DUAL) and
                      UPPER(table_name) LIKE UPPER('contenidoTipo%')";
        $tablasContenido = $pdo->query($sql);
     
        foreach ($tablasContenido as $tabla){
            $encontrado = Doctrine_Core::getTable($tabla['table_name'])->createQuery('j')->where('contenido_id = ?', $contenido_id)->count();
            if ($encontrado > 0){
                return $tabla['table_name'];
            }
        }
        //si llego a este punto, significa que no se ha encontrado ningun contenido del tipo buscado, asi que lanzo excepcion
        throw new sfException('Content with id('.$contenido_id.') not found. May be need create.');
    }
}

