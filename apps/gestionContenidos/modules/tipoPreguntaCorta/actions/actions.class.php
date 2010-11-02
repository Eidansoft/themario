<?php

/**
 * tipoPreguntaCorta actions.
 *
 * @package    themario
 * @subpackage tipoPreguntaCorta
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tipoPreguntaCortaActions extends sfActions
{
    public function executeRespuestaCuestion(sfWebRequest $request)
    {
        $this->cuestion_id = $request->getParameter('cuestion_id');
        $this->respuesta_corta = Doctrine_Core::getTable('TipoPreguntaCorta')->getTipoPreguntaCortaDeCuestionId($request->getParameter('cuestion_id'));
        $this->forward404Unless($this->respuesta_corta);
        $this->setTemplate('index');
        
        //en la template necesito el cuestionario_id con el que estoy trabajando
        $query = Doctrine_Core::getTable('Cuestion')->createQuery('j')->where('id = ?', $request->getParameter('cuestion_id'));
        $this->cuestionario_id = $query->fetchOne()->{'cuestionario_id'};
        //en la template necesito el tema_id y el curso_id con el que estoy trabajando
        $query = Doctrine_Core::getTable('ContenidoTipoCuestionario')->createQuery('j')->where('id = ?', $this->cuestionario_id);
        $query = Doctrine_Core::getTable('Contenido')->createQuery('j')->where('id = ?', $query->fetchOne()->{'contenido_id'});
        $this->tema_id = $query->fetchOne()->{'tema_id'};
        $query = Doctrine_Core::getTable('Tema')->createQuery('j')->where('id = ?', $this->tema_id);
        $this->curso_id = $query->fetchOne()->{'curso_id'};
    }
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipo_pregunta_cortas = Doctrine_Core::getTable('TipoPreguntaCorta')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->tipo_pregunta_corta = Doctrine_Core::getTable('TipoPreguntaCorta')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->tipo_pregunta_corta);
  }

  public function executeNew(sfWebRequest $request)
  {
    $respuesta = new TipoPreguntaCorta();
    $respuesta->setCuestion_id($request->getParameter('cuestion_id'));
    $this->form = new TipoPreguntaCortaForm($respuesta);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TipoPreguntaCortaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipo_pregunta_corta = Doctrine_Core::getTable('TipoPreguntaCorta')->find(array($request->getParameter('id'))), sprintf('Object tipo_pregunta_corta does not exist (%s).', $request->getParameter('id')));
    $this->form = new TipoPreguntaCortaForm($tipo_pregunta_corta);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipo_pregunta_corta = Doctrine_Core::getTable('TipoPreguntaCorta')->find(array($request->getParameter('id'))), sprintf('Object tipo_pregunta_corta does not exist (%s).', $request->getParameter('id')));
    $this->form = new TipoPreguntaCortaForm($tipo_pregunta_corta);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipo_pregunta_corta = Doctrine_Core::getTable('TipoPreguntaCorta')->find(array($request->getParameter('id'))), sprintf('Object tipo_pregunta_corta does not exist (%s).', $request->getParameter('id')));
    $tipo_pregunta_corta->delete();

    $this->redirect('tipoPreguntaCorta/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipo_pregunta_corta = $form->save();

      $this->redirect('tipoPreguntaCorta/show?id='.$tipo_pregunta_corta->getId());
    }
  }
}
