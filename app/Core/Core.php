<?php

class Core
{
    public function start($urlGet)
    {
        $acao = 'index';
        //validando se o usuario requisitou alguma pagina, caso contrario, cai na home
        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'] . 'Controller');
        } else {
            $controller = 'HomeController';
        }
        //fazendo verificação se existe a pagina ou não
        if (!class_exists($controller)) {
            $controller = 'ErroController';
        }

        call_user_func_array(array(new $controller, $acao), array());
    }
}
