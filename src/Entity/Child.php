<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildRepository")
 */
class Child
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Guardian", mappedBy="childs")
     */
    private $guardians;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sheet", mappedBy="child")
     */
    private $sheets;

    public function __construct()
    {
        $this->guardians = new ArrayCollection();
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
     * @return Collection|Guardian[]
     */
    public function getGuardians(): Collection
    {
        return $this->guardians;
    }

    public function addGuardian(Guardian $guardian): self
    {
        if (!$this->guardians->contains($guardian)) {
            $this->guardians[] = $guardian;
            $guardian->addChild($this);
        }

        return $this;
    }

    public function removeGuardian(Guardian $guardian): self
    {
        if ($this->guardians->contains($guardian)) {
            $this->guardians->removeElement($guardian);
            $guardian->removeChild($this);
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
}
