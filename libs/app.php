<?php


class App
{

    function __construct()
    {
        //se verifica que en el get de url halla un valor si lo hay lo asigna sino asigna null
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        //Se elimina cualquier / al final para normalizar 
        $url = rtrim($url, '/');
        //Se delimita la url mediante / y almacenamos en un array
        $url = explode('/', $url);
        if (empty($url[0])) {
            error_log('APP::construct->No hay controlador Especificado');
            $archivoController = "controllers/login.php";
            require_once $archivoController;
            $controller = new Login();
            //$controller->LoadModel('login');
            //$controller->render();

        }

        $archivoController = 'controllers/' . $url[0] . '.php';
        if (file_exists($archivoController)) {
            require_once $archivoController;
            $controller = new $url[0];
            $controller->LoadModel($url[0]);
            //Validamos si en la url el method a cargar esta definido sino cargue uno por defecto ejemplo controllers/products/show/
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    if (isset($url[2])) {
                        //llamamos al metodo pasandole parametros

                        //n° parametros
                        $nparam = count($url) - 2;

                        //Arreglo de parametros
                        $params = [];
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i] + 2);
                        }

                        $controller->{$url[1]}($params);
                    } else {
                        //Llamamos al metodo por defecto al no pasarle params
                        $controller->{$url[1]}();
                    }
                } else {
                    // Error no existe el metodo
                }
            } else {
                //no hay metodo definido entonces se carga el por default
                $controller->render();
            }
        } else {
            error_log('APP::construct->No existe el controlador');
        }
    }
}
