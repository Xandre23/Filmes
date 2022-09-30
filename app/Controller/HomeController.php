<?php

class HomeController
{
    public function index()
    {
        //verificando se tem algum registro na tabela
        try {
            $colecaoFilmes = Filmes::selecionaTodos();
            var_dump($colecaoFilmes);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
