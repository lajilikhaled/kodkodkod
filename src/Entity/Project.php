<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[Vich\Uploadable]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 500)]
    private $title;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $slug;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: "integer", nullable: true)]
    private $imageSize;

    #[ORM\Column(type: "integer", nullable: true)]
    private $priority;

    #[ORM\Column(type: "integer", nullable: true)]
    private $priorityKo;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $country;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $updatedAt;

    #[Vich\UploadableField(mapping: "projects", fileNameProperty: "image", size: "imageSize")]
    private $imageFile;

    #[ORM\Column(type: "text", nullable: true)]
    private $description;

    #[ORM\Column(type: "text", nullable: true)]
    private $descriptionKo;

    #[ORM\Column(type: "text", nullable: true)]
    private $descriptionEn;

    #[ORM\Column(type: "array", nullable: true)]
    private $technology = [];

    #[ORM\Column(type: "array", nullable: true)]
    private $ecommerce = [];

    #[ORM\Column(type: "array", nullable: true)]
    private $blockchain = [];

    #[ORM\Column(type: "text", nullable: true)]
    private $goal;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "projects")]
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getTechnology(): ?array
    {
        return $this->technology;
    }

    public function setTechnology(array $technology): self
    {
        $this->technology = $technology;

        return $this;
    }

	public function getEcommerce(): ?array
    {
        return $this->ecommerce;
    }

    public function setEcommerce(array $ecommerce): self
    {
        $this->ecommerce = $ecommerce;

        return $this;
    }

    public function getBlockchain(): ?array
    {
        return $this->blockchain;
    }

    public function setBlockchain(array $blockchain): self
    {
        $this->blockchain = $blockchain;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getImage()
         	{
         		return $this->image;
         	}

	/**
	 * @param mixed $image
	 */
	public function setImage($image): void
         	{
         		$this->image = $image;
         	}

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

	/**
	 * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
	 * of 'UploadedFile' is injected into this setter to trigger the update. If this
	 * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
	 * must be able to accept an instance of 'File' as the bundle will inject one here
	 * during Doctrine hydration.
	 *
	 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
	 */
	public function setImageFile(?File $imageFile = null): void
	{
		$this->imageFile = $imageFile;

		if (null !== $imageFile) {
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getImageFile(): ?File
	{
		return $this->imageFile;
	}

	public function setImageName(?string $imageName): void
	{
		$this->imageName = $imageName;
	}

	public function getImageName(): ?string
	{
		return $this->imageName;
	}

	public function setImageSize(?int $imageSize): void
	{
		$this->imageSize = $imageSize;
	}

	public function getImageSize(): ?int
	{
		return $this->imageSize;
	}

	/**
	 * @return \DateTimeInterface|null
	 */
	public function getUpdatedAt(): ?\DateTimeInterface
	{
		return $this->updatedAt;
	}

	/**
	 * @param \DateTimeInterface|null $updatedAt
	 */
	public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
	{
		$this->updatedAt = $updatedAt;
	}

	/**
	 * @return mixed
	 */
	public function getDescriptionKo()
	{
		return $this->descriptionKo;
	}

	/**
	 * @param mixed $descriptionKo
	 */
	public function setDescriptionKo($descriptionKo): void
	{
		$this->descriptionKo = $descriptionKo;
	}

	/**
	 * @return mixed
	 */
	public function getDescriptionEn()
	{
		return $this->descriptionEn;
	}

	/**
	 * @param mixed $descriptionEn
	 */
	public function setDescriptionEn($descriptionEn): void
	{
		$this->descriptionEn = $descriptionEn;
	}

	/**
	 * @return int|null
	 */
	public function getPriority(): ?int
	{
		return $this->priority;
	}

	/**
	 * @param int|null $priority
	 */
	public function setPriority(?int $priority): void
	{
		$this->priority = $priority;
	}

	/**
	 * @return mixed
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * @param mixed $country
	 */
	public function setCountry($country): void
	{
		$this->country = $country;
	}

	/**
	 * @return int|null
	 */
	public function getPriorityKo(): ?int
	{
		return $this->priorityKo;
	}

	/**
	 * @param int|null $priorityKo
	 */
	public function setPriorityKo(?int $priorityKo): void
	{
		$this->priorityKo = $priorityKo;
	}


}
