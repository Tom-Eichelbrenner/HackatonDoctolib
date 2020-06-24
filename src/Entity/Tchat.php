<?php

namespace App\Entity;

use App\Repository\TchatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TchatRepository::class)
 */
class Tchat
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Requests::class, inversedBy="tchat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $request;

    /**
     * @ORM\ManyToOne(targetEntity=Doctor::class, inversedBy="tchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is�Viewed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequest(): ?Requests
    {
        return $this->request;
    }

    public function setRequest(Requests $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getIs�Viewed(): ?bool
    {
        return $this->is�Viewed;
    }

    public function setIs�Viewed(bool $is�Viewed): self
    {
        $this->is�Viewed = $is�Viewed;

        return $this;
    }
}
