<?php

/**
 * RespuestaAlternativaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RespuestaAlternativaTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object RespuestaAlternativaTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('RespuestaAlternativa');
    }
    
    public function getArrayRespuestasDeCuestion($cuestion_id)
    {
        $respuestas = array();
        $tablaRespuestas = Doctrine_Core::getTable('RespuestaAlternativa')->createQuery('j')->where('cuestion_id = ?', $cuestion_id)->execute();
        foreach ($tablaRespuestas as $respuesta){
            $respuestas[$respuesta['id']] = $respuesta['texto'];
        }
        return $respuestas;
    }
}
