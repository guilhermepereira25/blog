<?php

namespace Blog\Source;

use mysqli;

class Artigo
{
    private $mysql;

    public function __construct(mysqli $mysql) 
    {
        $this->mysql = $mysql;
    }

    public function exibirTodos(): array
    {
        $sql = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos');
        
        //função que vai retornar um array associativo
        $artigos = $sql->fetch_all(MYSQLI_ASSOC);

        return $artigos;
    }

    public function adicionar(string $titulo, string $conteudo): void
    {
        $insereArtigo = $this->mysql->prepare('INSERT INTO artigos (titulo, conteudo) VALUES(?,?);');
        $insereArtigo->bind_param('ss', $titulo, $conteudo);
        $insereArtigo->execute();
    }

    public function searchById(string $id): array
    {
       $selectArticle = $this->mysql->prepare("SELECT id, titulo, conteudo FROM artigos WHERE id = ?");
       $selectArticle->bind_param('s', $id);
       $selectArticle->execute();

       $article = $selectArticle->get_result()->fetch_assoc();

       return $article;
    }

    public function excluir(string $id): void
    {
        $delete = $this->mysql->prepare('DELETE FROM `artigos` WHERE id = ?');
        $delete->bind_param('s', $id);
        $delete->execute();
    }

    public function editar(string $id, string $titulo, string $conteudo): void
    {
        $editArtigo = $this->mysql->prepare('UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?');
        $editArtigo->bind_param('sss', $titulo, $conteudo, $id);
        $editArtigo->execute();
    }
}

?>