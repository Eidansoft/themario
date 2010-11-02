<?php

/**
 * contenido actions.
 *
 * @package    themario
 * @subpackage contenido
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoActions extends sfActions
{
    public function executeDiferenciaContenidos(sfWebRequest $request)
    {
        $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j')->where('contenido_id = ?', $request->getParameter('contenido_id'))->count();
        if ($cuestionario > 0)
        {
            //$this->logMessage('#DiferenciaContenidos: Es un cuestionario', 'debug');
            $this->redirect('contenidoTipoCuestionario/cuestionariosContenido?contenido_id='.$request->getParameter('contenido_id'));
        }
        $texto = Doctrine_Core::getTable('ContenidoTipoTexto')->createQuery('j2')->where('contenido_id = ?', $request->getParameter('contenido_id'))->count();
        if ($texto > 0)
        {
            //$this->logMessage('#DiferenciaContenidos: Es un texto', 'debug');
            $this->redirect('contenidoTipoTexto/textosContenido?contenido_id='.$request->getParameter('contenido_id'));
        }
        //Si no ha entrado en los if's anteriores porque no esta aun definido el tipo del contenido, entonces mostrara
        // diferenciaContenidosSuccess.php y por ello le pasamos el id del contenido para que pueda trabajar
        $this->contenido_id = $request->getParameter('contenido_id');
    }

    public function executeContenidosTema(sfWebRequest $request)
    {
        $this->tema_id = $request->getParameter('tema_id');
        $this->contenidos = Doctrine_Core::getTable('Contenido')->getContenidosDeTemaId($request->getParameter('tema_id'));
        $this->forward404Unless($this->contenidos);
        $this->setTemplate('index');
        
        //en la template necesito el curso_id con el que estoy trabajando
        $query = Doctrine_Core::getTable('Tema')->createQuery('j')->where('id = ?', $request->getParameter('tema_id'));
        $this->curso_id = $query->fetchOne()->{'curso_id'};
    }
  public function executeIndex(sfWebRequest $request)
  {
    $this->contenidos = Doctrine_Core::getTable('Contenido')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->contenido);
  }

  public function executeNew(sfWebRequest $request)
  {
    $contenido = new Contenido();
    $contenido->setTema_id($request->getParameter('tema_id'));
    $this->form = new ContenidoForm($contenido);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoForm($contenido);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoForm($contenido);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $contenido->delete();

    $this->redirect('contenido/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contenido = $form->save();

      $this->redirect('contenido/show?id='.$contenido->getId());
    }
  }
}
