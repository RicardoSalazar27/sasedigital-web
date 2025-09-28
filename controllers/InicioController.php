<?php

namespace Controllers;

use MVC\Router;

class InicioController {
    public static function inicio(Router $router) {

        $router->render('sitio/inicio', [
            'titulo' => 'Confirma tu cuenta DevWebcamp',
        ]);
    }

    public static function productos(Router $router) {

        $router->render('sitio/productos', [
            'titulo' => 'Productos',
        ]);
    }
}