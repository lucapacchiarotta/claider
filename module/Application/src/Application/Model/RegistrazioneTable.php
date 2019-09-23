<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class RegistrazioneTable {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getRegistrazione($id) {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveRegistrazione(Registrazione $registrazione) {
        $data = array(
            'email' => $registrazione->email,
            'password'  => $registrazione->password,
            'nome'  => $registrazione->nome,
            'cognome'  => $registrazione->cognome
        );

        $id = (int)$registrazione->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getRegistrazione($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteRegistrazione($id) {
        $this->tableGateway->delete(array('id' => $id));
    }
}