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
        
        //Decido si el contenido seleccionado es de tipo texto o de tipo cuestionario
        $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j')->where('contenido_id = ?', $request->getParameter('id'))->count();
        if ($cuestionario > 0)
        {
            $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j3')->where('contenido_id = ?', $request->getParameter('id'));
            $this->redirect('themario/mostrarCuestionario?id='.$cuestionario->fetchOne()->{'id'});
        }
        $texto = Doctrine_Core::getTable('ContenidoTipoTexto')->createQuery('j2')->where('contenido_id = ?', $request->getParameter('id'))->count();
        if ($texto > 0)
        {
            $texto = Doctrine_Core::getTable('ContenidoTipoTexto')->createQuery('j4')->where('contenido_id = ?', $request->getParameter('id'));
            $this->redirect('themario/mostrarTexto?id='.$texto->fetchOne()->{'id'});
        }
        //Si no ha entrado en los if's anteriores es porque no esta aun definido el tipo del contenido
        //asique muestro el titulo definido y un comentario
        $query = Doctrine_Core::getTable('Contenido')->createQuery('j5')->where('id = ?', $request->getParameter('id'));
        $this->titulo = $query->fetchOne()->{'titulo'};
        $this->comentario = "Este contenido a&uacute;n no est&aacute; definido. Disculpa las molestias.";
        $this->setTemplate('index');
        
        
    }

    public function executeMostrarCuestionario(sfWebRequest $request)
    {
        $query = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j')->where('id = ?', $request->getParameter('id'));
        //cargo las listas
        $this->cargaListasDeContenido($query->fetchOne()->{'contenido_id'});
        
        //Titulo y cuestionario
        $query2 = Doctrine_Core::getTable('Contenido')->createQuery('j')->where('id = ?', $query->fetchOne()->{'contenido_id'});
        $this->titulo = $query2->fetchOne()->{'titulo'};
        $this->cuestionario_id = $request->getParameter('id');
        //el cuestionario sera un array con la pregunta, el tipo y el objeto respuesta del tipo que corresponda
        $this->cuestiones = array();
        $tablaCuestion = Doctrine_Core::getTable('Cuestion')->createQuery('j')->where('cuestionario_id = ?', $request->getParameter('id'))->execute();
        foreach ($tablaCuestion as $cuestion)
        {
            $respuesta = $this->eligeTipoCuestion($cuestion['id'], $cuestion['pregunta']);
            if ($respuesta != null)
            {
                $this->cuestiones[] = $respuesta;
            }
        }
    }

    public function executeMostrarTexto(sfWebRequest $request)
    {
        $query = Doctrine_Core::getTable('ContenidoTipoTexto')->createQuery('j')->where('id = ?', $request->getParameter('id'));
        //cargo las listas
        $this->cargaListasDeContenido($query->fetchOne()->{'contenido_id'});
        
        //Titulo y comentario que se mostrara
        
        $query2 = Doctrine_Core::getTable('Contenido')->createQuery('j')->where('id = ?', $query->fetchOne()->{'contenido_id'});
        $this->titulo = $query2->fetchOne()->{'titulo'};
        $this->comentario = $query->fetchOne()->{'texto'};
        
        $this->setTemplate('index');
    }
    
    public function executeTema(sfWebRequest $request)
    {
        $query = Doctrine_Core::getTable('Tema')->createQuery('j')->where('id = ?', $request->getParameter('id'));
        $curso_id = $query->fetchOne()->{'curso_id'};
        
        $this->cursos = $this->listaCursos($curso_id);
        $this->temas = $this->listaTemas($curso_id, $request->getParameter('id'));
        $this->contenidos = $this->listaContenidos($request->getParameter('id'));
        
        //Titulo y comentario que se mostrara
        $query = Doctrine_Core::getTable('Tema')->createQuery('j')->where('id = ?', $request->getParameter('id'));
        $this->titulo = $query->fetchOne()->{'nombre'};
        $this->comentario = "Selecciona el contenido del tema que quieres trabajar...";
        
        $this->setTemplate('index');
    }
    
    public function executeCurso(sfWebRequest $request)
    {
        $this->cursos = $this->listaCursos($request->getParameter('id'));
        $this->temas = $this->listaTemas($request->getParameter('id'));
        
        //Titulo y comentario que se mostrara
        $query = Doctrine_Core::getTable('Curso')->createQuery('j')->where('id = ?', $request->getParameter('id'));
        $this->titulo = $query->fetchOne()->{'nombre'};
        $this->comentario = "Selecciona el tema del curso que quieres trabajar...";
        
        $this->setTemplate('index');
    }
    
    public function executeIndex(sfWebRequest $request)
    {
        $this->titulo = "Themario";
        $this->comentario = "Selecciona el curso que quieres trabajar...";
        $this->cursos = $this->listaCursos();
    }
    
    public function executeSolucionCuestionario(sfWebRequest $request)
    {
        /*$cuestiones = Doctrine_Core::getTable('Cuestion')->createQuery('j')->where('cuestionario_id = ?', $request->getParameter('id'))->execute();
        foreach ($cuestiones as $cuestion){
            $tablaRespuesta = Doctrine_Core::getTable('Cuestion')->getTipoCuestion($cuestion->getId());
            include_once $tablaRespuesta.'.class.php';
            list($key, $value) = each($_POST);
        }*/
    }
/*
  public function executeShow(sfWebRequest $request)
  {
    $this->curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->curso);
  }
*/
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CuestionarioRespuestaAlternativaForm(2);
    $this->form->mergeform(new CuestionarioRespuestaCortaForm());
    //$this->form = new CuestionarioRespuestaAlternativaForm(2, $this->form);

  }
/*
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CursoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
    $this->form = new CursoForm($curso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
    $this->form = new CursoForm($curso);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
    $curso->delete();

    $this->redirect('themario/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $curso = $form->save();

      $this->redirect('themario/edit?id='.$curso->getId());
    }
  }
  */
}
