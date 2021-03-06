<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
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
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="doctor", cascade={"persist", "remove"})
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="doctors")
     */
    private $speciality;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="doctor")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="doctors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=AdviceRequest::class, mappedBy="doctor")
     */
    private $adviceRequests;

    /**
     * @ORM\ManyToMany(targetEntity=AdviceRequest::class, inversedBy="blacklisted")
     */
    private $blacklist;


    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->adviceRequests = new ArrayCollection();
        $this->blacklist = new ArrayCollection();
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
        if ($user->getDoctor() !== $this) {
            $user->setDoctor($this);
        }

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

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
            $message->setDoctor($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getDoctor() === $this) {
                $message->setDoctor(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

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
            $adviceRequest->setDoctor($this);
        }

        return $this;
    }

    public function removeAdviceRequest(AdviceRequest $adviceRequest): self
    {
        if ($this->adviceRequests->contains($adviceRequest)) {
            $this->adviceRequests->removeElement($adviceRequest);
            // set the owning side to null (unless already changed)
            if ($adviceRequest->getDoctor() === $this) {
                $adviceRequest->setDoctor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdviceRequest[]
     */
    public function getBlacklist(): Collection
    {
        return $this->blacklist;
    }

    public function addBlacklist(AdviceRequest $blacklist): self
    {
        if (!$this->blacklist->contains($blacklist)) {
            $this->blacklist[] = $blacklist;
        }

        return $this;
    }

    public function removeBlacklist(AdviceRequest $blacklist): self
    {
        if ($this->blacklist->contains($blacklist)) {
            $this->blacklist->removeElement($blacklist);
        }

        return $this;
    }

}
