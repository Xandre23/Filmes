<?php

class AdminController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $templete = $twig->load('admin.html');

        $objPostagens = Filmes::selecionaTodos();

        $parametros = array();
        $parametros['filmes'] = $objPostagens;

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
        try {
            Filmes::insert($_POST);
            echo '<script>alert("Filme Inserido com sucesso");</script>';
            echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=create"</script>';
        }
    }
}
