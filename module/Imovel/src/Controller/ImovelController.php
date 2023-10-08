<?php
namespace Imovel\Controller;

use Exception;
use Imovel\Form\ImovelForm;
use Imovel\Model\Imovel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger as FlashMessengerFlashMessenger;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Plugin\FlashMessenger\View\Helper\FlashMessenger;
use Zend\Mvc\Plugin\FlashMessenger\View\Helper\FlashMessengerFactory;

class ImovelController extends AbstractActionController

{

    private $table;
    public function __construct($table)
    {
        $this->table =  $table;
    }
    public function indexAction(){             
        return new ViewModel(['imoveis' => $this->table->getAll()]);
    }

    public function createAction(){
        try{
            $form = new ImovelForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if(!$request->isPost()){
            return new ViewModel(['form'=>$form]);
        }
        $imovel = new Imovel();
        $form->setData($request->getPost());
        if(!$form->isValid()){
            return new ViewModel(['form'=>$form]);
        }
        $imovel->exchangeArray($form->getData());
        $this->table->saveImovel($imovel);
        $this->FlashMessenger()->addSuccessMessage('Imovel criado com sucesso!');        
        return $this->redirect()->toRoute('imovel');
        }catch(Exception $e){            
            $this->FlashMessenger()->addErrorMessage('Ocorreu um erro ao criar o imovel, verifique as informações e tente novamente por favor!');            
            return $this->redirect()->toRoute('imovel');
        }
        
    }

    public function updateAction(){
        try{
            $id = (int)$this->params()->fromRoute('id',0);
            if ($id === 0){
                return $this->redirect()->toRoute('imovel', ['action'=>'create']);
            }
            $imovel = $this->table->getImovel($id);
            $form = new ImovelForm();
            $form->bind($imovel);
            $form->get('submit')->setAttribute('value', 'Salvar');
            $request = $this->getRequest();
            $viewData = ['id' => $id, 'form'=> $form];
            if(!$request->isPost()){
                return $viewData;
            }
            $form->setData($request->getPost());
            if(!$form->isValid()){
                return new $viewData;
            }
            $this->table->saveImovel($form->getData());
            $this->FlashMessenger()->addSuccessMessage('Imovel editado com sucesso!'); 
            return $this->redirect()->toRoute('imovel');
        }catch(Exception $e){
            $this->FlashMessenger()->addErrorMessage('Ocorreu um erro ao editar o imovel!');
            return $this->redirect()->toRoute('imovel', ['action'=>'index']);
        }
}

    public function deleteAction(){
        $id = (int)$this->params()->fromRoute('id',0);
        if ($id === 0){
            return $this->redirect()->toRoute('imovel', ['action'=>'create']);
        }
        try{
           $this->table->deleteImovel($id);
           $this->FlashMessenger()->addSuccessMessage('Imovel excluido com sucesso!'); 
           return $this->redirect()->toRoute('imovel');
        }catch(Exception $e){
            $this->FlashMessenger()->addErrorMessage('Ocorreu um erro ao excluir o imovel!');
            return $this->redirect()->toRoute('imovel', ['action'=>'index']);
        }
    }

    public function saveAction(){

        return new ViewModel();
    }
}