<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildRepository")
 */
class Child
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"child_list"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     * @Groups({"child_list"})
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     * @Groups({"child_list"})
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(type="string", length=1)
     * @Groups({"child_list"})
     */
    private $sexe;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     * @Groups({"child_list"})
     */
    private $birthdate;

    /**
     * @var User[] | ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="children")
     */
    private $users;

    /**
     * @var Sheet[] | ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Sheet", mappedBy="child")
     */
    private $sheets;

    /**
     * @var Nursery
     * @ORM\ManyToOne(targetEntity="App\Entity\Nursery", inversedBy="children")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nursery;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->sheets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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
            $user->addChild($this);
        }

        return $this;
    }

    public function removeGuardian(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeChild($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sheet[]
     */
    public function getSheets(): Collection
    {
        return $this->sheets;
    }

    public function addSheet(Sheet $sheet): self
    {
        if (!$this->sheets->contains($sheet)) {
            $this->sheets[] = $sheet;
            $sheet->addChild($this);
        }

        return $this;
    }

    public function removeSheet(Sheet $sheet): self
    {
        if ($this->sheets->contains($sheet)) {
            $this->sheets->removeElement($sheet);
            $sheet->removeChild($this);
        }

        return $this;
    }

    public function getNursery(): ?Nursery
    {
        return $this->nursery;
    }

    public function setNursery(?Nursery $nursery): self
    {
        $this->nursery = $nursery;

        return $this;
    }
}
