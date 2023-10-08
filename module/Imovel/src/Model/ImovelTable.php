<?php
namespace Imovel\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ImovelTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getAll(){        
        return $this->tableGateway->select();
    }

    public function getImovel($id){
        $id = (int)$id;
        $imovel = $this->tableGateway->select(['id' => $id]);
        if(!$imovel->current()){
            throw new RuntimeException(sprintf('Não foi encontrado esse imovel!'));
        }
        return $imovel->current();
    }

    public function saveImovel(Imovel $imovel){
        $data = [
            'tipo' => $imovel->tipo,
            'endereco' => $imovel->endereco,
            'preco' => $imovel->preco,
            'status' => $imovel->status
        ];

        $id = (int)$imovel->id;
        if ($id === 0){
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data,['id'=>$id]);
    }

    public function deleteImovel($id){
        $this->tableGateway->delete(['id'=>(int)$id]);
    }
}