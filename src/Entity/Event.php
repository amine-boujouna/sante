<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Assert\NotBlank
     *
     */
    private $minicontenu;

    /**
     * @ORM\Column(type="string", length=5000)
     * @Assert\NotBlank
     *
     */
    private $maxcontenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrlike;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrdislike;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrparticipants;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateevent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rate;

    /**
     * @ORM\OneToMany(targetEntity=Temoignage::class, mappedBy="event",cascade={"all"},orphanRemoval=true)
     */
    private $temoignages;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="events")
     */
    private $users;

    public function __construct()
    {
        $this->temoignages = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMinicontenu(): ?string
    {
        return $this->minicontenu;
    }

    public function setMinicontenu(?string $minicontenu): self
    {
        $this->minicontenu = $minicontenu;

        return $this;
    }

    public function getMaxcontenu(): ?string
    {
        return $this->maxcontenu;
    }

    public function setMaxcontenu(string $maxcontenu): self
    {
        $this->maxcontenu = $maxcontenu;

        return $this;
    }

    public function getNbrlike(): ?int
    {
        return $this->nbrlike;
    }

    public function setNbrlike(?int $nbrlike): self
    {
        $this->nbrlike = $nbrlike;

        return $this;
    }

    public function getNbrdislike(): ?int
    {
        return $this->nbrdislike;
    }

    public function setNbrdislike(?int $nbrdislike): self
    {
        $this->nbrdislike = $nbrdislike;

        return $this;
    }

    public function getNbrparticipants(): ?int
    {
        return $this->nbrparticipants;
    }

    public function setNbrparticipants(?int $nbrparticipants): self
    {
        $this->nbrparticipants = $nbrparticipants;

        return $this;
    }

    public function getDateevent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateevent(?\DateTimeInterface $dateevent): self
    {
        $this->dateevent = $dateevent;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return Collection|Temoignage[]
     */
    public function getTemoignages(): Collection
    {
        return $this->temoignages;
    }

    public function addTemoignage(Temoignage $temoignage): self
    {
        if (!$this->temoignages->contains($temoignage)) {
            $this->temoignages[] = $temoignage;
            $temoignage->setEvent($this);
        }

        return $this;
    }

    public function removeTemoignage(Temoignage $temoignage): self
    {
        if ($this->temoignages->removeElement($temoignage)) {
            // set the owning side to null (unless already changed)
            if ($temoignage->getEvent() === $this) {
                $temoignage->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
