<?php
namespace Imovel\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class ImovelForm extends Form{

    public function __construct()
    {
        
        parent::__construct('imovel', []);
        $this->add(new Hidden('id'));
        $tipo = new Select('tipo', ['label'=>'tipo imovel: ']);
        $tipo->setValueOptions([
            'casa' => 'casa',
            'apartamento' => 'apartamento',
            'terreno' => 'terreno'
        ]);
        $this->add($tipo);             
        $this->add(new Text('endereco', ['label'=> 'Endereço: ']));
        $this->add(new Text('preco', ['label'=>'Preço: ']));
        $status = new Select('status', ['label'=> 'Status: ']);
        $status->setValueOptions([
            'disponivel' => 'disponível',
            'alugado' => 'alugado',
            'vendido' => 'vendido'
        ]);
        $this->add($status);
        $submit = new Submit('submit');
        $submit->setAttributes(['value'=>'Salvar', 'id'=>'submitButton']);
        $this->add($submit);
    }
}