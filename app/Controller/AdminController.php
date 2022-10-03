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
    public function change($paramId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $templete = $twig->load('update.html');
        
        $post = Filmes::selecionarPorId($paramId);

        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['titulo'] = $post->titulo;
        $parametros['capa'] = $post->capa;
        $parametros['ano'] = $post->ano;
        $parametros['diretor'] = $post->diretor;
        $parametros['avaliacao'] = $post->avaliacao;

        $conteudo =  $templete->render($parametros);
        echo $conteudo;
    }
    public function update()
    {
        try {

            Filmes::update($_POST);

            echo '<script>alert("Filme alterado com sucesso");</script>';
            echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=change&id=' . $_POST['id'] . '"</script>';
        }
    }
    public function delete($paramId)
    {
        try {
            Filmes::delete($paramId);
            echo '<script>alert("Filme deletado com sucesso");</script>';
            echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=index' . $_POST['id'] . '"</script>';
        }
    }
}
