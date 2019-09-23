<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Registrazione implements InputFilterAwareInterface {
    public $email;
    public $password;
    public $password2;
    public $nome;
    public $cognome;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->email     = (isset($data['email'])) ? $data['email'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->password2 = (isset($data['password2'])) ? $data['password2'] : null;
        $this->nome  = (isset($data['nome']))  ? $data['nome']  : null;
        $this->cognome  = (isset($data['cognome']))  ? $data['cognome']  : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 20,
                        )
                    ),
                    array(
                        'name'    => 'EmailAddress'
                    )
                )
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'password',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 12,
                        )
                    )
                )
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'password2',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 12,
                        )
                    ),
                    array(
                        'name'    => 'Identical',
                        'options' => array(
                            'token' => 'password'
                        )
                    )
                )
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}