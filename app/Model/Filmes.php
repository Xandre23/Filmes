<?php

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
        $con = Connection::getConn();
        $sql = 'INSERT INTO filme (titulo,ano,diretor,avaliacao) VALUES (:tit, :ano, :dir, :ava)';
        $sql = $con->prepare($sql);
        $sql->bindValue(':tit', $dadosPost['titulo']);
        $sql->bindValue(':ano', $dadosPost['ano']);
        $sql->bindValue(':dir', $dadosPost['diretor']);
        $sql->bindValue(':ava', $dadosPost['avaliacao']);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception("Dados não inserido na tabela");
            return false;
        }
        return true;
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
}
