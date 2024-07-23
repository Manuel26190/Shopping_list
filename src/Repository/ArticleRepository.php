<?php

namespace App\Repository;
use App\Entity\Article;
use PDO;
use phpDocumentor\Reflection\Types\Void_;

class ArticleRepository{
    private PDO $connexion;
    public function __construct(){
        
        $this->connexion = new PDO("mysql:host=localhost;dbname=shopping_list", "root", "");
    }

    // Methode pour afficher mes articles
    public function findAll():array|null{
        $query = $this->connexion->prepare('SELECT * FROM article');
        $query->execute();
        return $query->fetchAll();
    }

    // Methode pour ajouter un article
    public function addArticle(Article $article):void {
        $query = $this->connexion->prepare('INSERT INTO article (content) VALUES (:content)');
        $query->bindValue(':content', $article->getContent());
        $query->execute();
        $article->setId($this->connexion->lastInsertId());

    }

    // Methode pour supprimer un article
    public function delete(Article $article):void {
        $query = $this->connexion->prepare('DELETE FROM article WHERE id = :id');
        $query->bindValue(':id', $article->getId());
        $query->execute();
    }
}