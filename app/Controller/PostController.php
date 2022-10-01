<?php

class PostController
{
    public function index($params)

    {

        //verificando se tem algum registro na tabela
        try {
            $postagem = Filmes::selecionarPorId($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $templete = $twig->load('single.html');


            $parametros = array();
            $parametros['titulo'] = $postagem->titulo;
            $parametros['capa'] = $postagem->capa;
            $parametros['ano'] = $postagem->ano;
            $parametros['diretor'] = $postagem->diretor;
            $parametros['avaliacao'] = $postagem->avaliacao;
            $conteudo =  $templete->render($parametros);

            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
