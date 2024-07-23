<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Article{
    private ?int $id;

    #[Assert\NotBlank]
    private string $content;

    
    public function __construct(int $id, string $content){ 
        $this->id = $id;
        $this->content = $content;
    }

    

    public function getId(): ?int{
        return $this->id;
    }
    public function setId(int $id){
        $this->id = $id;
        return $this;
    }  
    public function getContent(): string{
        return $this->content;
    }
    public function setContent(string $content): self{
        $this->content = $content;
        return $this;
    }

}