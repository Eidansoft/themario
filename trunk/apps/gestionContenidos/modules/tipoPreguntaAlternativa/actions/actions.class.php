<?php

/**
 * tipoPreguntaAlternativa actions.
 *
 * @package    themario
 * @subpackage tipoPreguntaAlternativa
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tipoPreguntaAlternativaActions extends sfActions
{

    
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipo_pregunta_alternativas = Doctrine_Core::getTable('TipoPreguntaAlternativa')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->tipo_pregunta_alternativa = Doctrine_Core::getTable('TipoPreguntaAlternativa')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->tipo_pregunta_alternativa);
  }

  public function executeNew(sfWebRequest $request)
  {
    //$this->form = new TipoPreguntaAlternativaForm();
    $pregunta = new TipoPreguntaAlternativa();
    $pregunta->setCuestion_id($request->getParameter('cuestion_id'));
    $this->form = new TipoPreguntaAlternativaForm($pregunta);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TipoPreguntaAlternativaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipo_pregunta_alternativa = Doctrine_Core::getTable('TipoPreguntaAlternativa')->find(array($request->getParameter('id'))), sprintf('Object tipo_pregunta_alternativa does not exist (%s).', $request->getParameter('id')));
    $this->form = new TipoPreguntaAlternativaForm($tipo_pregunta_alternativa);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipo_pregunta_alternativa = Doctrine_Core::getTable('TipoPreguntaAlternativa')->find(array($request->getParameter('id'))), sprintf('Object tipo_pregunta_alternativa does not exist (%s).', $request->getParameter('id')));
    $this->form = new TipoPreguntaAlternativaForm($tipo_pregunta_alternativa);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipo_pregunta_alternativa = Doctrine_Core::getTable('TipoPreguntaAlternativa')->find(array($request->getParameter('id'))), sprintf('Object tipo_pregunta_alternativa does not exist (%s).', $request->getParameter('id')));
    $tipo_pregunta_alternativa->delete();

    $this->redirect('tipoPreguntaAlternativa/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipo_pregunta_alternativa = $form->save();

      //$this->redirect('tipoPreguntaAlternativa/edit?id='.$tipo_pregunta_alternativa->getId());
      //$this->redirect('respuestaTipoPreguntaAlternativa/respuestasTipo?tipo_id='.$tipo_pregunta_alternativa->getId());
      $this->redirect('respuestaTipoPreguntaAlternativa/respuestaCuestion?tipoPregunta_id='.$tipo_pregunta_alternativa->getId());
    }
  }
}
