<?php

namespace App\Controller;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/shopping-list')]

class ArticleController extends AbstractController{
     
    public function __construct(private ArticleRepository $repo) { }

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
        $this->repo->addArticle($article);
        return $this->json($article, 201);
    }
    
}