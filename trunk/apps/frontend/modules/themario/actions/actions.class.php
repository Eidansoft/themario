<?php

/**
 * themario actions.
 *
 * @package    themario
 * @subpackage themario
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class themarioActions extends sfActions
{
    private function listaCursos($curso_id_actual = -1)
    {
        $cursos = array();
        $tablaCursos = Doctrine_Core::getTable('Curso')->getCursos();
        foreach ($tablaCursos as $elemento){
            $cursos[] = array('texto'   => $elemento->getNombre(),
                              'url'     => $this->getController()->genUrl('themario/curso?id='.$elemento->getId()),
                              'actual'  => ($elemento->getId() == $curso_id_actual ? true : false));
        }
        return $cursos;
    }
    
    private function listaTemas($curso_id_actual, $tema_id_actual = -1)
    {
        $temas = array();
        $tablaTema = Doctrine_Core::getTable('Tema')->getTemasDeCursoId($curso_id_actual);
        foreach ($tablaTema as $elemento){
            $temas[] = array('texto'    => $elemento->getNombre(),
                              'url'     => $this->getController()->genUrl('themario/tema?id='.$elemento->getId()),
                              'actual'  => ($elemento->getId() == $tema_id_actual ? true : false));
        }
        return $temas;
    }
    
    private function listaContenidos($tema_id_actual, $contenido_id_actual = -1)
    {
        $contenidos = array();
        $tablaContenidos = Doctrine_Core::getTable('Contenido')->getContenidosDeTemaId($tema_id_actual);
        foreach ($tablaContenidos as $elemento){
            $contenidos[] = array('texto'   => $elemento->getTitulo(),
                                  'url'     => $this->getController()->genUrl('themario/contenido?id='.$elemento->getId()),
                                  'actual'  => ($elemento->getId() == $contenido_id_actual ? true : false));
        }
        return $contenidos;
    }
    
    private function cargaListasDeContenido($contenido_id)
    {
        //Cargo las listas que crean el arbol de navegacion del menu
        $tema_id = Doctrine_Core::getTable('Contenido')->find($contenido_id)->getTema_id();
        $curso_id = Doctrine_Core::getTable('Tema')->find($tema_id)->getCurso_id();
        
        $this->cursos = $this->listaCursos($curso_id);
        $this->temas = $this->listaTemas($curso_id, $tema_id);
        $this->contenidos = $this->listaContenidos($tema_id);
    }
    
    private function eligeTipoCuestion($cuestion_id, $pregunta)
    {
        try {
            $tablaRespuesta = Doctrine_Core::getTable('Cuestion')->getTipoCuestion($cuestion_id);
            $respuestaCuestion = Doctrine_Core::getTable($tablaRespuesta)->createQuery('j3')->where('cuestion_id = ?', $cuestion_id)->execute();
            $respuestas = array(    'tipo'       => $tablaRespuesta,
                                    'pregunta'   => $pregunta,
                                    'respuestas' => $respuestaCuestion,
                                    'cuestion'   => $cuestion_id
                               );
            return $respuestas;
        } catch (sfException $e) {
            return NULL;
        }
    }
    
    public function executeContenido(sfWebRequest $request)
    {   
        //cargo las listas
        $this->cargaListasDeContenido($request->getParameter('id'));
        
        //Según el tipo del contenido seleccionado, redirecciono a uno u otro metodo
        try {
            $tablaContenidoTipo = Doctrine_Core::getTable('Contenido')->getTipoContenido($request->getParameter('id'));
            $contenidoTipo = Doctrine_Core::getTable($tablaContenidoTipo)->createQuery('j3')->where('contenido_id = ?', $request->getParameter('id'));
            $this->redirect('themario/' . $tablaContenidoTipo . '?id='.$contenidoTipo->fetchOne()->{'id'});
        } catch (sfException $e) {
            //Si se recibe una excepcion es porque no esta aun definido el tipo del contenido
            //asique muestro el titulo definido y un comentario
            $query = Doctrine_Core::getTable('Contenido')->createQuery('j5')->where('id = ?', $request->getParameter('id'));
            $this->titulo = $query->fetchOne()->{'titulo'};
            $this->comentario = sfConfig::get('app_frontend_msgContenidoNoDefinido');
            $this->setTemplate('index');
        }
    }
/* PRIMERA VERSION, LOS FORMULARIOS LOS CREO YO A MANO
    public function executeContenidoTipoCuestionario(sfWebRequest $request)
    {
        $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find($request->getParameter('id'));
        //cargo las listas
        $this->cargaListasDeContenido($cuestionario->getContenido_id());
        
        //Titulo y cuestionario
        $contenido = Doctrine_Core::getTable('Contenido')->find($cuestionario->getContenido_id());
        $this->titulo = $contenido->getTitulo();
        $this->cuestionario_id = $cuestionario->getId();
        //el cuestionario sera un array con la pregunta, el tipo y el objeto respuesta del tipo que corresponda
        $this->cuestiones = array();
        $tablaCuestion = Doctrine_Core::getTable('Cuestion')->getCuestionDeCuestionarioId($cuestionario->getId());
        foreach ($tablaCuestion as $cuestion)
        {
            $respuesta = $this->eligeTipoCuestion($cuestion['id'], $cuestion['pregunta']);
            if ($respuesta != null)
            {
                $this->cuestiones[] = $respuesta;
            }
        }
    }
*/
    public function executeContenidoTipoTexto(sfWebRequest $request)
    {
        $texto = Doctrine_Core::getTable('ContenidoTipoTexto')->find($request->getParameter('id'));
        //cargo las listas
        $this->cargaListasDeContenido($texto->getContenido_id());
        
        //Titulo y comentario que se mostrara
        
        $contenido = Doctrine_Core::getTable('Contenido')->find($texto->getContenido_id());
        $this->titulo = $contenido->getTitulo();
        $this->comentario = $texto->getTexto();
        
        $this->setTemplate('index');
    }
    
    public function executeTema(sfWebRequest $request)
    {
        $tema = Doctrine_Core::getTable('Tema')->find($request->getParameter('id'));
        $curso_id = $tema->getCurso_id();
        
        $this->cursos = $this->listaCursos($curso_id);
        $this->temas = $this->listaTemas($curso_id, $request->getParameter('id'));
        $this->contenidos = $this->listaContenidos($request->getParameter('id'));
        
        //Titulo y comentario que se mostrara
        $this->titulo = $tema->getNombre();
        $this->comentario = sfConfig::get('app_frontend_msgSelecionaContenido');
        
        $this->setTemplate('index');
    }
    
    public function executeCurso(sfWebRequest $request)
    {
        $this->cursos = $this->listaCursos($request->getParameter('id'));
        $this->temas = $this->listaTemas($request->getParameter('id'));
        
        //Titulo y comentario que se mostrara
        $curso = Doctrine_Core::getTable('Curso')->find($request->getParameter('id'));
        $this->titulo = $curso->getNombre();
        $this->comentario = sfConfig::get('app_frontend_msgSelecionaTema');
        
        $this->setTemplate('index');
    }
    
    public function executeIndex(sfWebRequest $request)
    {
        $this->titulo = sfConfig::get('app_frontend_tituloApp');
        $this->comentario = sfConfig::get('app_frontend_msgSeleccionaCurso');;
        $this->cursos = $this->listaCursos();
    }
    
    //SEGUNDA VERSION, UTILIZO LOS FORMULARIOS DEL FRAMEWORK
    //public function executeMuestraCuestionario(sfWebRequest $request)
    public function executeContenidoTipoCuestionario(sfWebRequest $request)
    {
        //cargo las listas
        $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find($request->getParameter('id'));
        $contenido = Doctrine_Core::getTable('Contenido')->find($cuestionario->getContenido_id());
        $this->cargaListasDeContenido($cuestionario->getContenido_id());
        $this->titulo = $contenido->getTitulo();
        
        //creo el formulario para que se muestre
        $this->form = $this->creaCuestionario($request->getParameter('id'));
    }
    
    private function creaCuestionario($cuestionario_id)
    {
        $cuestiones = Doctrine_Core::getTable('Cuestion')->getCuestionDeCuestionarioId($cuestionario_id);
        $form = new CuestionarioGenericoForm($cuestionario_id);
        foreach ($cuestiones as $cuestion){
            $cuestionTipo = Doctrine_Core::getTable('Cuestion')->getTipoCuestion($cuestion->getId());
            $objTipoPregunta = Doctrine_Core::getTable($cuestionTipo)->createQuery('j3')->where('cuestion_id = ?', $cuestion->getId())->fetchOne();

            $form->mergeForm($objTipoPregunta->getFormularioRespuesta($cuestion->getId()));
        }
        return $form;
    }

    private function salvarCuestionario($parametrosRecibidos)
    {
        $cuestiones = Doctrine_Core::getTable('Cuestion')->getCuestionDeCuestionarioId($parametrosRecibidos['cuestionario_id']);
        foreach ($cuestiones as $cuestion){
            $fecha = time();
            $alumno = Doctrine_Core::getTable('Alumno')->find(1);
            
            //Creo una nueva respuesta
            $respuesta = new Respuesta();
            
            //Creo la nueva relacion CuestionAlumnoRespuesta
            $cuestionAlumnoRespuesta = new CuestionAlumnoRespuesta();
            $cuestionAlumnoRespuesta->setCuestion($cuestion);
            $cuestionAlumnoRespuesta->setAlumno($alumno);
            $cuestionAlumnoRespuesta->setFecha($fecha);
            $cuestionAlumnoRespuesta->setRespuesta($respuesta);
            
            $respuesta->save();
            
            //En funcion del tipo de cuestion, creo su tipo correspondiente y su respuesta

            $cuestionTipo = Doctrine_Core::getTable('Cuestion')->getTipoCuestion($cuestion->getId());
            $objTipoPregunta = Doctrine_Core::getTable($cuestionTipo)->createQuery('j3')->where('cuestion_id = ?', $cuestion->getId())->fetchOne();
            $objTipoPregunta->getFormularioRespuesta($cuestion->getId())->getRespuestaRellena($respuesta, $cuestion->getId(), $parametrosRecibidos);
                        
            $cuestionAlumnoRespuesta->save();
        }
        return true;
    }

    public function executeCreate(sfWebRequest $request)
    {
        //Compruebo que recibo datos por POST y entr ellos esta el "cuestionario_id"
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $temporal = new CuestionarioGenericoForm(-1);
        $parametrosRecibidos = $request->getParameter($temporal->getName());
        $this->forward404Unless(isset($parametrosRecibidos['cuestionario_id']));

        $this->form = $this->creaCuestionario($parametrosRecibidos['cuestionario_id']);

        $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
        if ($this->form->isValid())
        {
            if ($this->salvarCuestionario($parametrosRecibidos))
            {
                $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find($parametrosRecibidos['cuestionario_id']);
                $contenido = Doctrine_Core::getTable('Contenido')->find($cuestionario->getContenido_id());
                $tema = Doctrine_Core::getTable('Tema')->find($contenido->getTema_id());
                $curso_id = $tema->getCurso_id();
                
                $this->cursos = $this->listaCursos($curso_id);
                $this->temas = $this->listaTemas($curso_id, $contenido->getTema_id());
                $this->contenidos = $this->listaContenidos($contenido->getTema_id());
                
                //Titulo y comentario que se mostrara
                $this->titulo = 'Guardado';
                $this->comentario = 'Respuestas procesadas con exito. Gracias !';
                
                $this->setTemplate('index');
            } else {
                $this->titulo = 'ERROR';
                $this->comentario ='Ha ocurrido un error al salvar la informacion';
                $this->setTemplate('index');
            }
        } else {
            //El formulario tiene errores o faltan campos obligatorios
            //cargo las listas
            $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find($parametrosRecibidos['cuestionario_id']);
            $contenido = Doctrine_Core::getTable('Contenido')->find($cuestionario->getContenido_id());
            $this->cargaListasDeContenido($cuestionario->getContenido_id());
            $this->titulo = $contenido->getTitulo();
            
            $this->setTemplate('contenidoTipoCuestionario');
        }
    }
}
