<?php

class Filmes
{
    public static function selecionaTodos()
    {
        $con = new PDO('mysql: host=localhost; dbname=filmes;', 'root', '');
        var_dump($con);
    }
}
