<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Article
{
    private ?int $id = null;  // ID est optionnel et initialisé à null

    #[Assert\NotBlank]  // Content ne peut pas être vide
    private string $content;

    public function __construct(?int $id = null, string $content)  // ID est optionnel
    { 
        $this->id = $id;
        $this->content = $content;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
