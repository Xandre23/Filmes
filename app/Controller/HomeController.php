<?php

class HomeController
{
    public function index()
    {
        //verificando se tem algum registro na tabela
        try {
            $colecaoFilmes = Filmes::selecionaTodos();
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $templete = $twig->load('home.html');


            $parametros = array();
            $parametros['filmes'] = $colecaoFilmes;
            $conteudo =  $templete->render($parametros);

            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
