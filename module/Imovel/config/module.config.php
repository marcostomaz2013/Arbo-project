<?php
namespace Imovel;
// use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'imovel' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/imovel[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-z][a-zA-Z-0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\ImovelController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    // 'controllers' =>[
    //     'factories' => [
    //         Controller\ImovelController::class => InvokableFactory::class,
    //     ],
    // ],
    'view_manager' => [
        'template_path_stack'=>[
            'imovel' => __DIR__.'/../view',
        ]
    ],
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'arposuperlogica',
        'username' => 'root',
        'password' => 'root',
        'hostname' => 'mariadb',
        'port' => '3306'
    ],

];