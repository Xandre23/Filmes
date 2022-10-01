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
}
