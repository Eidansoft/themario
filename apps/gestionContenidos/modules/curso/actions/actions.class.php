<?php

/**
 * curso actions.
 *
 * @package    themario
 * @subpackage curso
 * @author     Alejandro Lorente. eidansoft ARROBA gmail PUNTO com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cursoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cursos = Doctrine_Core::getTable('Curso')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->curso);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CursoForm();
  }

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

    $this->redirect('curso/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $curso = $form->save();

      $this->redirect('curso/show?id='.$curso->getId());
    }
  }
}
