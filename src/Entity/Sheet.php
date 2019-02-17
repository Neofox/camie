<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SheetRepository")
 */
class Sheet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $data = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Child", inversedBy="sheets")
     */
    private $child;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SheetType", inversedBy="sheets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->child = new ArrayCollection();
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return Collection|Child[]
     */
    public function getChild(): Collection
    {
        return $this->child;
    }

    public function addChild(Child $child): self
    {
        if (!$this->child->contains($child)) {
            $this->child[] = $child;
        }

        return $this;
    }

    public function removeChild(Child $child): self
    {
        if ($this->child->contains($child)) {
            $this->child->removeElement($child);
        }

        return $this;
    }

    public function getType(): ?SheetType
    {
        return $this->type;
    }

    public function setType(?SheetType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
