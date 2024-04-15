<?php

namespace App\Entity;

use App\Repository\ConversionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConversionRepository::class)
 */
class Conversion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $name;

	/**
	 * @ORM\Column(type="string", length=500, nullable=true)
	 */
	private $phone;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $messsage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $spam;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $Company;

	/**
	 * @ORM\Column(type="string", length=1000, nullable=true)
	 */
	private $typeProject;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $googleRes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMesssage(): ?string
    {
        return $this->messsage;
    }

    public function setMesssage(?string $messsage): self
    {
        $this->messsage = $messsage;

        return $this;
    }

    public function getSpam(): ?bool
    {
        return $this->spam;
    }

    public function setSpam(?bool $spam): self
    {
        $this->spam = $spam;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->Company;
    }

    public function setCompany(?string $Company): self
    {
        $this->Company = $Company;

        return $this;
    }

    public function getGoogleRes(): ?string
    {
        return $this->googleRes;
    }

    public function setGoogleRes(?string $googleRes): self
    {
        $this->googleRes = $googleRes;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param mixed $phone
	 */
	public function setPhone($phone): void
	{
		$this->phone = $phone;
	}

	/**
	 * @return mixed
	 */
	public function getTypeProject()
	{
		return $this->typeProject;
	}

	/**
	 * @param mixed $typeProject
	 */
	public function setTypeProject($typeProject): void
	{
		$this->typeProject = $typeProject;
	}


}
