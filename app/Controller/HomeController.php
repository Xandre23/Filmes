<?php

class HomeController
{
    public function index()
    {
        //  echo 'Home';
        Filmes::selecionaTodos();
    }
}
