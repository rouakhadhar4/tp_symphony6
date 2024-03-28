<?php
namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Category; // Import de la classe Category


#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: "Le nom d'un article doit comporter au moins {{ limit }} caractères",
        maxMessage: "Le nom d'un article ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $Nom = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    #[Assert\GreaterThan(
        value: 0,
        message: "Le prix d’un article doit être supérieur à 0"
    )]
    private ?string $Prix = null;

    
    #[ORM\ManyToOne(targetEntity: Category::class, cascade: ["remove"])]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "id", nullable: false)]
private ?Category $category = null;
    
public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(?string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
