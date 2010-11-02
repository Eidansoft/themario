<?php

/**
 * contenidoTipoCuestionario actions.
 *
 * @package    themario
 * @subpackage contenidoTipoCuestionario
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoTipoCuestionarioActions extends sfActions
{
    public function executeCuestionariosContenido(sfWebRequest $request)
    {
        $cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j')->where('contenido_id = ?', $request->getParameter('contenido_id'));
        //$this->forward404Unless($this->cuestionarios);
        //$this->setTemplate('index');
        //$cuestionario = Doctrine_Core::getTable('Cuestionario')->getCuestionFromCuestionario($request->getParameter('cuestionario_id'));
        $this->redirect('cuestion/cuestionesCuestionario?cuestionario_id='.$cuestionario->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR));
    }
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->contenido_tipo_cuestionarios = Doctrine_Core::getTable('ContenidoTipoCuestionario')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->contenido_tipo_cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->contenido_tipo_cuestionario);
  }

  public function executeNew(sfWebRequest $request)
  {
    //$this->form = new ContenidoTipoCuestionarioForm();
    $cuestionario = new ContenidoTipoCuestionario();
    $cuestionario->setContenido_id($request->getParameter('contenido_id'));
    $this->form = new ContenidoTipoCuestionarioForm($cuestionario);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoTipoCuestionarioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contenido_tipo_cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find(array($request->getParameter('id'))), sprintf('Object contenido_tipo_cuestionario does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoTipoCuestionarioForm($contenido_tipo_cuestionario);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contenido_tipo_cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find(array($request->getParameter('id'))), sprintf('Object contenido_tipo_cuestionario does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoTipoCuestionarioForm($contenido_tipo_cuestionario);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($contenido_tipo_cuestionario = Doctrine_Core::getTable('ContenidoTipoCuestionario')->find(array($request->getParameter('id'))), sprintf('Object contenido_tipo_cuestionario does not exist (%s).', $request->getParameter('id')));
    $contenido_tipo_cuestionario->delete();

    $this->redirect('contenidoTipoCuestionario/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contenido_tipo_cuestionario = $form->save();

      //$this->redirect('contenidoTipoCuestionario/edit?id='.$contenido_tipo_cuestionario->getId());
      
      $this->redirect('cuestion/cuestionesCuestionario?cuestionario_id='.$contenido_tipo_cuestionario->getId());
    }
  }
}
