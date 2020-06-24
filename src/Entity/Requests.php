<?php

namespace App\Entity;

use App\Repository\RequestsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RequestsRepository::class)
 */
class Requests
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="requests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;


    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Tchat::class, mappedBy="request", cascade={"persist", "remove"})
     */
    private $tchat;

    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="requests")
     */
    private $pathology;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTchat(): ?Tchat
    {
        return $this->tchat;
    }

    public function setTchat(Tchat $tchat): self
    {
        $this->tchat = $tchat;

        // set the owning side of the relation if necessary
        if ($tchat->getRequest() !== $this) {
            $tchat->setRequest($this);
        }

        return $this;
    }

    public function getPathology(): ?Speciality
    {
        return $this->pathology;
    }

    public function setPathology(?Speciality $pathology): self
    {
        $this->pathology = $pathology;

        return $this;
    }
}
