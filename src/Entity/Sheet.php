<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SheetRepository")
 */
class Sheet
{
    public const TYPE_DAILY = 1;

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"history", "sheet"})
     */
    private $id;

    /**
     * @var array
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"sheet"})
     */
    private $data = [];

    /**
     * @var Child[] | ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Child", inversedBy="sheets")
     */
    private $child;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({"history", "sheet"})
     */
    private $type;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=false)
     * @Groups({"history", "sheet"})
     */
    private $createdAt;

    public function __construct(int $type)
    {
        $this->setType($type);

        $this->child = new ArrayCollection();
        $this->createdAt = new \DateTime();
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public static function getAllTypes(): array
    {
        return (new \ReflectionClass(__CLASS__))->getConstants();
    }

    public function setType(?int $type): self
    {
        if (!in_array($type, $this->getAllTypes())) {
            throw new \LogicException(sprintf('Type "%s is not a valid Sheet Type.', $type));
        }
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    //TODO: change that (with updated at?)
    public function setCreatedAt(\DateTimeInterface $date): self
    {
        $this->createdAt = $date;

        return $this;
    }
}
