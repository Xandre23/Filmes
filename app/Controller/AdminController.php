<?php

class AdminController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $templete = $twig->load('admin.html');


        $parametros = array();

        $conteudo =  $templete->render($parametros);

        echo $conteudo;
    }
    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $templete = $twig->load('create.html');

        $parametros = array();
        $conteudo =  $templete->render($parametros);
        echo $conteudo;
    }
    public function insert()
    {
        var_dump($_POST);
    }
}
