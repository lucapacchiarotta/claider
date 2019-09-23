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
                //$this->getAlbumTable()->saveAlbum($registrazione);

                // Redirect to list of albums
                return $this->redirect()->toUrl('/registrazione/grazie');
            }
        }
        return array('form' => $form);
        //return new ViewModel();
    }

    public function grazieAction() {
        return new ViewModel();
    }
}
