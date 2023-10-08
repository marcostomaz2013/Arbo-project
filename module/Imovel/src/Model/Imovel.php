<?php
namespace Imovel\Model;

use Zend\Stdlib\ArraySerializableInterface;

class Imovel implements ArraySerializableInterface
{
    public $id;
    public $tipo;
    public $endereco;
    public $preco;
    public $status;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->tipo = !empty($data['tipo']) ? $data['tipo'] : null;
        $this->endereco  = !empty($data['endereco']) ? $data['endereco'] : null;
        $this->preco  = !empty($data['preco']) ? $data['preco'] : null;
        $this->status  = !empty($data['status']) ? $data['status'] : null;
    }
    public function getArrayCopy() : array
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'endereco' => $this->endereco,
            'preco' => $this->preco,
            'status' => $this->status
        ];     
    }
}