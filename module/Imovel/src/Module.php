<?php
namespace Imovel;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Imovel\Controller\ImovelController;
class Module implements ConfigProviderInterface{

    public function getConfig(){

        return include __DIR__."/../config/module.config.php";

    }

    public function getServiceConfig(){
        return [
            'factories'=> [
                Model\ImovelTable::class => function ($container){
                    $tableGateway = $container->get(Model\ImovelTableGateway::class);
                    return new Model\ImovelTable($tableGateway);
                },
                Model\ImovelTableGateway::class => function($container){
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Imovel());
                    return new TableGateway('imovel', $dbAdapter, null, $resultSetPrototype);
                },
            ]
        ];
    }

    public function getControllerConfig(){
        return [
            'factories' => [
                ImovelController::class => function ($container){
                    $tableGateway = $container->get(Model\ImovelTable::class);
                    return new ImovelController($tableGateway);
                }
            ],
        ];
    }
}
