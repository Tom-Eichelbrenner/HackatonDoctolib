<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lName;

    /**
     * @ORM\Column(type="date")
     */
    private $bdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $disease;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="patient", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=AdviceRequest::class, mappedBy="patient")
     */
    private $adviceRequests;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="patient")
     */
    private $messages;

    public function __construct()
    {
        $this->adviceRequests = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFName(): ?string
    {
        return $this->fName;
    }

    public function setFName(string $fName): self
    {
        $this->fName = $fName;

        return $this;
    }

    public function getLName(): ?string
    {
        return $this->lName;
    }

    public function setLName(string $lName): self
    {
        $this->lName = $lName;

        return $this;
    }

    public function getBdate(): ?\DateTimeInterface
    {
        return $this->bdate;
    }

    public function setBdate(\DateTimeInterface $bdate): self
    {
        $this->bdate = $bdate;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDisease(): ?string
    {
        return $this->disease;
    }

    public function setDisease(?string $disease): self
    {
        $this->disease = $disease;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        // set the owning side of the relation if necessary
        if ($user->getPatient() !== $this) {
            $user->setPatient($this);
        }

        return $this;
    }

    /**
     * @return Collection|AdviceRequest[]
     */
    public function getAdviceRequests(): Collection
    {
        return $this->adviceRequests;
    }

    public function addAdviceRequest(AdviceRequest $adviceRequest): self
    {
        if (!$this->adviceRequests->contains($adviceRequest)) {
            $this->adviceRequests[] = $adviceRequest;
            $adviceRequest->setPatient($this);
        }

        return $this;
    }

    public function removeAdviceRequest(AdviceRequest $adviceRequest): self
    {
        if ($this->adviceRequests->contains($adviceRequest)) {
            $this->adviceRequests->removeElement($adviceRequest);
            // set the owning side to null (unless already changed)
            if ($adviceRequest->getPatient() === $this) {
                $adviceRequest->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setPatient($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getPatient() === $this) {
                $message->setPatient(null);
            }
        }

        return $this;
    }

}
