<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("project_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("project_read")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Groups("project_read")
     */
    private $discription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("project_read")
     */
    private $file;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("project_read")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("project_read")
     */
    private $end_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("project_read")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pai", inversedBy="projects")
     * @Groups("project_read")
     */
    private $pai;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPai(): ?Pai
    {
        return $this->pai;
    }

    public function setPai(?Pai $pai): self
    {
        $this->pai = $pai;

        return $this;
    }



}
