<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\RegistrazioneForm;
use Application\Model\Registrazione;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegistrazioneController extends AbstractActionController {

    protected $registrazioneTable;

    public function indexAction()     {
        $form = new RegistrazioneForm();
        $form->get('submit')->setValue('Salva i dati');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $registrazione = new Registrazione();
            $form->setInputFilter($registrazione->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $registrazione->exchangeArray($form->getData());
                $this->getRegistrazioneTable()->saveRegistrazione($registrazione);

                // Redirect to list of albums
                return $this->redirect()->toRoute('grazie');
            }
        }
        return array('form' => $form);
    }

    public function grazieAction() {
        return new ViewModel();
    }

    public function getRegistrazioneTable() {
        if (!$this->registrazioneTable) {
            $sm = $this->getServiceLocator();
            $this->registrazioneTable = $sm->get('Application\Model\RegistrazioneTable');
        }
        return $this->registrazioneTable;
    }
}
