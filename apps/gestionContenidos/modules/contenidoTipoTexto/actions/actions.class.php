<?php

/**
 * contenidoTipoTexto actions.
 *
 * @package    themario
 * @subpackage contenidoTipoTexto
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoTipoTextoActions extends sfActions
{
    public function executeTextosContenido(sfWebRequest $request)
    {
        $this->textos = Doctrine_Core::getTable('ContenidoTipoTexto')->getTextoDeContenido($request->getParameter('contenido_id'));
        $this->forward404Unless($this->textos);
        $this->setTemplate('index');
        
        //en la template necesito el tema_id y el curso_id con el que estoy trabajando
        $query = Doctrine_Core::getTable('Contenido')->createQuery('j')->where('id = ?', $request->getParameter('contenido_id'));
        $this->tema_id = $query->fetchOne()->{'tema_id'};
        $query = Doctrine_Core::getTable('Tema')->createQuery('j')->where('id = ?', $this->tema_id);
        $this->curso_id = $query->fetchOne()->{'curso_id'};
        
    }

  public function executeIndex(sfWebRequest $request)
  {
    $this->textos = Doctrine_Core::getTable('ContenidoTipoTexto')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->texto = Doctrine_Core::getTable('ContenidoTipoTexto')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->texto);
  }

  public function executeNew(sfWebRequest $request)
  {
    $texto = new ContenidoTipoTexto();
    $texto->setContenido_id($request->getParameter('contenido_id'));
    $this->form = new ContenidoTipoTextoForm($texto);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoTipoTextoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($texto = Doctrine_Core::getTable('ContenidoTipoTexto')->find(array($request->getParameter('id'))), sprintf('Object texto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoTipoTextoForm($texto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($texto = Doctrine_Core::getTable('ContenidoTipoTexto')->find(array($request->getParameter('id'))), sprintf('Object texto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoTipoTextoForm($texto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($texto = Doctrine_Core::getTable('ContenidoTipoTexto')->find(array($request->getParameter('id'))), sprintf('Object texto does not exist (%s).', $request->getParameter('id')));
    $texto->delete();

    $this->redirect('contenidoTipoTexto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $texto = $form->save();

      $this->redirect('contenidoTipoTexto/show?id='.$texto->getId());
    }
  }
}
