<?php
namespace Application\Form;

use Zend\Form\Form;

class RegistrazioneForm extends Form {
    public function __construct($name = null) {
        parent::__construct('album');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'Email',
            )
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
            )
        ));
        $this->add(array(
            'name' => 'password2',
            'type' => 'Password',
            'options' => array(
                'label' => 'Conferma password',
            ),
        ));
        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome',
            )
        ));
        $this->add(array(
            'name' => 'cognome',
            'type' => 'Text',
            'options' => array(
                'label' => 'Cognome',
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Salva i dati',
                'id' => 'submitbutton'
            )
        ));
    }
}