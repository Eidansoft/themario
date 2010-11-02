<?php

/**
 * cuestion actions.
 *
 * @package    themario
 * @subpackage cuestion
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuestionActions extends sfActions
{
    public function executeDiferenciaCuestiones(sfWebRequest $request)
    {
        $respAlternativa = Doctrine_Core::getTable('TipoPreguntaAlternativa')->createQuery('j')->where('cuestion_id = ?', $request->getParameter('cuestion_id'))->count();
        if ($respAlternativa > 0)
        {
            $resp = Doctrine_Core::getTable('TipoPreguntaAlternativa')->createQuery('j')->where('cuestion_id = ?', $request->getParameter('cuestion_id'))->fetchOne();
            $this->redirect('respuestaTipoPreguntaAlternativa/respuestaCuestion?tipoPregunta_id='.$resp->getId());
        }
        $respCorta = Doctrine_Core::getTable('TipoPreguntaCorta')->createQuery('j2')->where('cuestion_id = ?', $request->getParameter('cuestion_id'))->count();
        if ($respCorta > 0)
        {
            //$this->logMessage('#DiferenciaContenidos: Es un texto', 'debug');
            $this->redirect('tipoPreguntaCorta/respuestaCuestion?cuestion_id='.$request->getParameter('cuestion_id'));
        }
        //Si no ha entrado en los if's anteriores porque no esta aun definido el tipo de las respuestas, entonces mostrara
        // diferenciaCuestionesSuccess.php y por ello le pasamos el id de la cuestion para que pueda trabajar
        $this->cuestion_id = $request->getParameter('cuestion_id');
    }

    public function executeCuestionesCuestionario(sfWebRequest $request)
    {
        $this->cuestionario_id = $request->getParameter('cuestionario_id');
        $this->cuestions = Doctrine_Core::getTable('Cuestion')->getCuestionDeCuestionarioId($request->getParameter('cuestionario_id'));
        $this->forward404Unless($this->cuestions);
        $this->setTemplate('index');
        
        //en la template necesito el tema_id y el curso_id con el que estoy trabajando
        $query = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j')->where('id = ?', $request->getParameter('cuestionario_id'));
        $query = Doctrine_Core::getTable('Contenido')->createQuery('j')->where('id = ?', $query->fetchOne()->{'contenido_id'});
        $this->tema_id = $query->fetchOne()->{'tema_id'};
        $query = Doctrine_Core::getTable('Tema')->createQuery('j')->where('id = ?', $this->tema_id);
        $this->curso_id = $query->fetchOne()->{'curso_id'};
    }
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->cuestions = Doctrine_Core::getTable('Cuestion')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->cuestion = Doctrine_Core::getTable('Cuestion')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->cuestion);
  }

  public function executeNew(sfWebRequest $request)
  {
    $cuestion = new Cuestion();
    $cuestion->setCuestionario_id($request->getParameter('cuestionario_id'));
    $this->form = new CuestionForm($cuestion);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CuestionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cuestion = Doctrine_Core::getTable('Cuestion')->find(array($request->getParameter('id'))), sprintf('Object cuestion does not exist (%s).', $request->getParameter('id')));
    $this->form = new CuestionForm($cuestion);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cuestion = Doctrine_Core::getTable('Cuestion')->find(array($request->getParameter('id'))), sprintf('Object cuestion does not exist (%s).', $request->getParameter('id')));
    $this->form = new CuestionForm($cuestion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cuestion = Doctrine_Core::getTable('Cuestion')->find(array($request->getParameter('id'))), sprintf('Object cuestion does not exist (%s).', $request->getParameter('id')));
    $cuestion->delete();

    $this->redirect('cuestion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cuestion = $form->save();

      $this->redirect('cuestion/show?id='.$cuestion->getId());
    }
  }
}
