<?php

namespace App\Entity;

use App\Repository\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @ORM\Entity(repositoryClass=EntityRepository::class)
 */
class Entity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $onApp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $onServer;

    /**
     * @ORM\OneToMany(targetEntity=Save::class, mappedBy="entities")
     */
    private $saves;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->saves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getOnApp(): ?int
    {
        return $this->onApp;
    }

    public function setOnApp(?int $onApp): self
    {
        $this->onApp = $onApp;

        return $this;
    }

    public function getOnServer(): ?int
    {
        return $this->onServer;
    }

    public function setOnServer(?int $onServer): self
    {
        $this->onServer = $onServer;

        return $this;
    }

    /**
     * @return Collection|Save[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    /**
     * @return Collection|Save[]
     */
    public function getSaves(): Collection
    {
        return $this->saves;
    }

    public function addSave(Save $save): self
    {
        if (!$this->saves->contains($save)) {
            $this->saves[] = $save;
            $save->setEntities($this);
        }

        return $this;
    }

    public function removeSave(Save $save): self
    {
        if ($this->saves->removeElement($save)) {
            // set the owning side to null (unless already changed)
            if ($save->getEntities() === $this) {
                $save->setEntities(null);
            }
        }

        return $this;
    }
}
