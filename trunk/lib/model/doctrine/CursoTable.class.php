<?php

/**
 * CursoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CursoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CursoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Curso');
    }
    
    public function getCursos(){
        return Doctrine_Core::getTable('Curso')->createQuery('a')->execute();
    }
}
