<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    // public function comprobarRutas()
    // {

    //     $url_actual = $_SERVER['PATH_INFO'] ?? '/';
    //     $method = $_SERVER['REQUEST_METHOD'];

    //     if ($method === 'GET') {
    //         $fn = $this->getRoutes[$url_actual] ?? null;
    //     } else {
    //         $fn = $this->postRoutes[$url_actual] ?? null;
    //     }

    //     if ( $fn ) {
    //         call_user_func($fn, $this);
    //     } else {
    //         echo "Página No Encontrada o Ruta no válida";
    //     }
    // }
    public function comprobarRutas()
{
    // 1) Tomar la URI cruda
    $uri = $_SERVER['REQUEST_URI'] ?? '/';

    // 2) Quitar query string
    $uri = parse_url($uri, PHP_URL_PATH) ?? '/';

    // 3) Normalizar (decode y quitar trailing slash, excepto en raíz)
    $uri = rawurldecode($uri);
    $uri = rtrim($uri, '/');
    if ($uri === '') { $uri = '/'; }

    // 4) Si tu app NO vive en raíz (no es tu caso), quitar base:
    // $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
    // if ($base && $base !== '/' && str_starts_with($uri, $base)) {
    //     $uri = substr($uri, strlen($base));
    //     $uri = $uri === '' ? '/' : $uri;
    // }

    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    $fn = $method === 'GET'
        ? ($this->getRoutes[$uri]  ?? null)
        : ($this->postRoutes[$uri] ?? null);

    if ($fn) {
        call_user_func($fn, $this);
    } else {
        http_response_code(404);
        echo "Página No Encontrada o Ruta no válida";
    }
}


    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        include_once __DIR__ . '/views/layout.php';
    }
}
