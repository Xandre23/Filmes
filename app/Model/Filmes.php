<?php
session_start();
class Filmes
{
    public static function selecionaTodos()
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM filme ORDER BY avaliacao DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        $resultado = array();

        while ($row = $sql->fetchObject('Filmes')) {
            $resultado[] = $row;
        }

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }
        return $resultado;
    }

    public static function selecionarPorId($idPost)
    {
        $con = Connection::getConn();
        $sql = "SELECT * FROM filme WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Filmes');

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }
        return $resultado;
    }
    public static function insert($dadosPost)
    {
        //VALIDAÇÃO DE Dados simples
        if (empty($dadosPost['titulo']) or empty($dadosPost['ano']) or empty($dadosPost['diretor']) or empty($dadosPost['avaliacao'])) {
            throw new Exception("Preencha todos os campos");

            return false;
        }

        //vld img

        $SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
        if ($SendCadImg) {
            //Receber os dados do formulário
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
            $nome_imagem = $_FILES['capa']['name'];
            $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_FLOAT);
            $diretor = filter_input(INPUT_POST, 'diretor', FILTER_SANITIZE_STRING);
            $avaliacao = filter_input(INPUT_POST, 'avaliacao', FILTER_SANITIZE_NUMBER_INT);

            $con = Connection::getConn();
            $result_img = "INSERT INTO filme (titulo,capa,ano,diretor,avaliacao) VALUES (:tit,:cap, :ano, :dir, :ava)";
            $insert_msg = $con->prepare($result_img);
            $insert_msg->bindParam(':tit', $titulo);
            $insert_msg->bindParam(':cap', $nome_imagem);
            $insert_msg->bindParam(':ano', $ano);
            $insert_msg->bindParam(':dir', $diretor);
            $insert_msg->bindParam(':ava', $avaliacao);
            //Verificar se os dados foram inseridos com sucesso
            if ($insert_msg->execute()) {
                //Recuperar último ID inserido no banco de dados
                $ultimo_id = $con->lastInsertId();

                //Diretório onde o arquivo vai ser salvo
                $diretorio = 'arquivo/' . $ultimo_id . '/';

                //Criar a pasta de foto 
                mkdir($diretorio, 0755);





                if (move_uploaded_file($_FILES['capa']['tmp_name'], $diretorio . $nome_imagem)) {
                    echo '<script>alert("Filme Inserido com sucesso");</script>';
                    echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=index"</script>';
                } else {
                    echo '<script>alert("Filme inseridos com sucesso. Erro ao fazer uplod da imagem, faça alteração");</script>';
                    echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=index"</script>';
                }
            } else {
                echo '<script>alert("Erro ao salvar os dados, tente novamente");</script>';
                echo '<script>location.href="http://localhost:8080/Filmes/?pagina=admin&metodo=create"</script>';
            }
        }
    }
    public static function update($params)
    {
        $con = Connection::getConn();
        $sql = "UPDATE filme SET titulo = :tit, capa = :cap, ano = :ano, diretor = :dir, avaliacao = :ava WHERE id = :id";
        $sql = $con->prepare($sql);

        $sql->bindValue(':tit', $params['titulo']);
        $sql->bindValue(':cap', $params['capa']);
        $sql->bindValue(':ano', $params['ano']);
        $sql->bindValue(':dir', $params['diretor']);
        $sql->bindValue(':ava', $params['avaliacao']);
        $sql->bindValue(':id', $params['id']);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception("Falha ao alterar");
            return false;
        }
        return true;
    }
    public static function delete($id)
    {
        $con = Connection::getConn();

        $sql = "DELETE FROM filme WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception("Falha ao deletar filme");
            return false;
        }
        return true;
    }
}
