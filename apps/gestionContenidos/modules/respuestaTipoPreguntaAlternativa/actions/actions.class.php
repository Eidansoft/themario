<?php

/**
 * respuestaTipoPreguntaAlternativa actions.
 *
 * @package    themario
 * @subpackage respuestaTipoPreguntaAlternativa
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class respuestaTipoPreguntaAlternativaActions extends sfActions
{
    public function executeRespuestaCuestion(sfWebRequest $request)
    {
        $this->tipoPregunta_id = $request->getParameter('tipoPregunta_id');
        $this->respuesta_tipo_pregunta_alternativas = Doctrine_Core::getTable('RespuestaTipoPreguntaAlternativa')->getRespuestaDeTipoPreguntaId($request->getParameter('tipoPregunta_id'));
        $this->forward404Unless($this->respuesta_tipo_pregunta_alternativas);
        $this->setTemplate('index');
        
        //en la template necesito el cuestionario_id con el que estoy trabajando
        $tipoCuestion = Doctrine_Core::getTable('TipoPreguntaAlternativa')->find($request->getParameter('tipoPregunta_id'));
        $query = Doctrine_Core::getTable('Cuestion')->createQuery('j')->where('id = ?', $tipoCuestion->getCuestion_id());
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
        $this->respuesta_tipo_pregunta_alternativas = Doctrine_Core::getTable('RespuestaTipoPreguntaAlternativa')
        ->createQuery('a')
        ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->respuesta_tipo_pregunta_alternativa = Doctrine_Core::getTable('RespuestaTipoPreguntaAlternativa')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->respuesta_tipo_pregunta_alternativa);
  }

  public function executeNew(sfWebRequest $request)
  {
    //$this->form = new RespuestaTipoPreguntaAlternativaForm();
    $tipo = new RespuestaTipoPreguntaAlternativa();
    $tipo->setTipopreguntaalternativaId($request->getParameter('tipoPregunta_id'));
    $this->form = new RespuestaTipoPreguntaAlternativaForm($tipo);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RespuestaTipoPreguntaAlternativaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($respuesta_tipo_pregunta_alternativa = Doctrine_Core::getTable('RespuestaTipoPreguntaAlternativa')->find(array($request->getParameter('id'))), sprintf('Object respuesta_tipo_pregunta_alternativa does not exist (%s).', $request->getParameter('id')));
    $this->form = new RespuestaTipoPreguntaAlternativaForm($respuesta_tipo_pregunta_alternativa);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($respuesta_tipo_pregunta_alternativa = Doctrine_Core::getTable('RespuestaTipoPreguntaAlternativa')->find(array($request->getParameter('id'))), sprintf('Object respuesta_tipo_pregunta_alternativa does not exist (%s).', $request->getParameter('id')));
    $this->form = new RespuestaTipoPreguntaAlternativaForm($respuesta_tipo_pregunta_alternativa);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($respuesta_tipo_pregunta_alternativa = Doctrine_Core::getTable('RespuestaTipoPreguntaAlternativa')->find(array($request->getParameter('id'))), sprintf('Object respuesta_tipo_pregunta_alternativa does not exist (%s).', $request->getParameter('id')));
    $respuesta_tipo_pregunta_alternativa->delete();

    $this->redirect('respuestaTipoPreguntaAlternativa/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $respuesta_tipo_pregunta_alternativa = $form->save();

      $this->redirect('respuestaTipoPreguntaAlternativa/show?id='.$respuesta_tipo_pregunta_alternativa->getId());
    }
  }
}
