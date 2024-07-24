<?php

namespace App\Controller;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/shopping-list')]

class ArticleController extends AbstractController{
     
    public function __construct(private ArticleRepository $repo) { }

    public function one(int $id): JsonResponse {
        
        $article = $this->repo->findById($id);
        //Si on a pas trouvé le chien pour cet id, on renvoie une erreur 404
        if(!$article) {
            throw new NotFoundHttpException("Article not found");
            //ou bien ça, fondamentalement, c'est à peu près la même chose
            //return $this->json('Dog not found', 404);
            
        }
        return $this->json($article);
    }

    #[Route(methods: ['GET'])]
    public function all ():JsonResponse{
        if($this->repo->findAll()){
            return $this->json($this->repo->findAll());
        }else{  
            return $this->json(['message' => 'No articles found'], 404);
        }
    }

    #[Route(methods: ['POST'])]
    public function addArticle(#[MapRequestPayload]Article $article):JsonResponse{
        $this->repo->persist($article);
        return $this->json($article, 201);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function removeArticle(int $id):JsonResponse{
        $this->one($id);
        if( $this->one($id)) {
            $this->repo->remove($id);
            return $this->json('Article supprimé', 204);
        }else{
            return $this->json('Article not found', 404);
        }   
    }   
}