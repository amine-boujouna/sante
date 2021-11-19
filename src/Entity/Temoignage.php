<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\TemoignageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemoignageRepository::class)
 */
class Temoignage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5000)
     * @Assert\NotBlank
     */
    private $temoignage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * * @Assert\NotBlank
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="temoignages")
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="temoignage",cascade={"all"},orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_commentaire;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemoignage(): ?string
    {
        return $this->temoignage;
    }

    public function setTemoignage(string $temoignage): self
    {
        $this->temoignage = $temoignage;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setTemoignage($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getTemoignage() === $this) {
                $commentaire->setTemoignage(null);
            }
        }

        return $this;
    }

    public function getNbrCommentaire(): ?int
    {
        return $this->nbr_commentaire;
    }

    public function setNbrCommentaire(?int $nbr_commentaire): self
    {
        $this->nbr_commentaire = $nbr_commentaire;

        return $this;
    }
}
