<?php

class HomeController
{
    public function index()
    {
        //  echo 'Home';
        $colecaoFilme = Filmes::selecionaTodos();
        var_dump($colecaoFilme);
    }
}
