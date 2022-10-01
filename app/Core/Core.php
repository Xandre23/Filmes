<?php

class Core
{
    public function start($urlGet)
    {
        if (isset($urlGet['metodo'])) {
            $acao = $urlGet['metodo'];
        } else {
            $acao = 'index';
        }
        //validando se o usuario requisitou alguma pagina, caso contrario, cai na home
        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'] . 'Controller');
        } else {
            $controller = 'HomeController';
        }
        if (!class_exists($controller)) {
            $controller = 'ErroController';
        }
        //fazendo verificação se existe a pagina ou não
        if (isset($urlGet['id']) && ($urlGet['id'] != null)) {
            $id = $urlGet['id'];
        } else {
            $id = null;
        }

        call_user_func(array(new $controller, $acao), $id);
    }
}
