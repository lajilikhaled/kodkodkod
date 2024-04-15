<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @Vich\Uploadable
 */
class Project
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=500)
	 */
	private $title;

	/**
	 * @ORM\Column(type="string", length=255,nullable=true)
	 */
	private $slug;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $image;


	/**
	 * @ORM\Column(type="integer", nullable=true)
	 *
	 * @var int|null
	 */
	private $imageSize;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 *
	 * @var int|null
	 */
	private $priority;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 *
	 * @var int|null
	 */
	private $priorityKo;

	/**
	 * @ORM\Column(type="string", length=255,nullable=true)
	 */
	private $country;

	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 *
	 * @var \DateTimeInterface|null
	 */
	private $updatedAt;


	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="image", size="imageSize")
	 *
	 * @var File|null
	 */
	private $imageFile;


	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $descriptionKo;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $descriptionEn;

	/**
	 * @ORM\Column(type="array",nullable=true)
	 */
	private $technology = [];

	/**
	 * @ORM\Column(type="array",nullable=true)
	 */
	private $ecommerce = [];

	/**
	 * @ORM\Column(type="array",nullable=true)
	 */
	private $blockchain = [];

	/**
	 * @ORM\Column(type="text",nullable=true)
	 */
	private $goal;

	/**
	 * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="projects")
	 */
	private $category;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideOneImageRight;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideOneImageRight")
	 *
	 * @var File|null
	 */
	private $slideOneImageRightFile;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideOneImageCenter;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideOneImageCenter")
	 *
	 * @var File|null
	 */
	private $slideOneImageCenterFile;


	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideOneImageLeft;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideOneImageLeft")
	 *
	 * @var File|null
	 */
	private $slideOneImageLeftFile;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideTwoImageLeft;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideTwoImageLeft")
	 *
	 * @var File|null
	 */
	private $slideTwoImageLeftFile;


	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideTwoImageRight;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideTwoImageRight")
	 *
	 * @var File|null
	 */
	private $slideTwoImageRightFile;


	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideThreeImage1Left;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideThreeImage1Left")
	 *
	 * @var File|null
	 */
	private $slideThreeImage1LeftFile;


	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideThreeImage2Right;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideThreeImage2Right")
	 *
	 * @var File|null
	 */
	private $slideThreeImage2RightFile;


	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideThreeImage3Left;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideThreeImage3Left")
	 *
	 * @var File|null
	 */
	private $slideThreeImage3LeftFile;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slideThreeImage4Right;

	/**
	 * @Vich\UploadableField(mapping="projects", fileNameProperty="slideThreeImage4Right")
	 *
	 * @var File|null
	 */
	private $slideThreeImage4RightFile;

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

	public function getSlideOneImageRight(): ?string
	{
		return $this->slideOneImageRight ?: 'default.png';
	}

	public function setSlideOneImageRight(?string $slideOneImageRight): self
	{
		$this->slideOneImageRight = $slideOneImageRight;

		return $this;
	}

	public function setSlideOneImageRightFile(?File $slideOneImageRightFile = null): void
	{
		$this->slideOneImageRightFile = $slideOneImageRightFile;

		if (null !== $slideOneImageRightFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideOneImageRightFile(): ?File
	{
		return $this->slideOneImageRightFile;
	}


	public function getSlideOneImageLeft(): ?string
	{
		return $this->slideOneImageLeft ?: 'default.png';
	}

	public function setSlideOneImageLeft(?string $slideOneImageLeft): self
	{
		$this->slideOneImageLeft = $slideOneImageLeft;

		return $this;
	}

	public function setSlideOneImageLeftFile(?File $slideOneImageLeftFile = null): void
	{
		$this->slideOneImageLeftFile = $slideOneImageLeftFile;

		if (null !== $slideOneImageLeftFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideOneImageLeftFile(): ?File
	{
		return $this->slideOneImageLeftFile;
	}

	public function getSlideOneImageCenter(): ?string
	{
		return $this->slideOneImageCenter ?: 'default.png';
	}

	public function setSlideOneImageCenter(?string $slideOneImageCenter): self
	{
		$this->slideOneImageCenter = $slideOneImageCenter;

		return $this;
	}

	public function setSlideOneImageCenterFile(?File $slideOneImageCenterFile = null): void
	{
		$this->slideOneImageCenterFile = $slideOneImageCenterFile;

		if (null !== $slideOneImageCenterFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideOneImageCenterFile(): ?File
	{
		return $this->slideOneImageCenterFile;
	}

	public function getSlideTwoImageLeft(): ?string
	{
		return $this->slideTwoImageLeft ?: 'default.png';
	}

	public function setSlideTwoImageLeft(?string $slideTwoImageLeft): self
	{
		$this->slideTwoImageLeft = $slideTwoImageLeft;

		return $this;
	}

	public function setSlideTwoImageLeftFile(?File $slideTwoImageLeftFile = null): void
	{
		$this->slideTwoImageLeftFile = $slideTwoImageLeftFile;

		if (null !== $slideTwoImageLeftFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideTwoImageLeftFile(): ?File
	{
		return $this->slideTwoImageLeftFile;
	}

	public function getSlideTwoImageRight(): ?string
	{
		return $this->slideTwoImageRight ?: 'default.png';
	}

	public function setSlideTwoImageRight(?string $slideTwoImageRight): self
	{
		$this->slideTwoImageRight = $slideTwoImageRight;

		return $this;
	}

	public function setSlideTwoImageRightFile(?File $slideTwoImageRightFile = null): void
	{
		$this->slideTwoImageRightFile = $slideTwoImageRightFile;

		if (null !== $slideTwoImageRightFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideTwoImageRightFile(): ?File
	{
		return $this->slideTwoImageRightFile;
	}

	public function getSlideThreeImage1Left(): ?string
	{
		return $this->slideThreeImage1Left ?: 'default.png';
	}

	public function setSlideThreeImage1Left(?string $slideThreeImage1Left): self
	{
		$this->slideThreeImage1Left = $slideThreeImage1Left;

		return $this;
	}

	public function setSlideThreeImage1LeftFile(?File $slideThreeImage1LeftFile = null): void
	{
		$this->slideThreeImage1LeftFile = $slideThreeImage1LeftFile;

		if (null !== $slideThreeImage1LeftFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideThreeImage1LeftFile(): ?File
	{
		return $this->slideThreeImage1LeftFile;
	}

	public function getSlideThreeImage2Right(): ?string
	{
		return $this->slideThreeImage2Right ?: 'default.png';
	}

	public function setSlideThreeImage2Right(?string $slideThreeImage2Right): self
	{
		$this->slideThreeImage2Right = $slideThreeImage2Right;

		return $this;
	}

	public function setSlideThreeImage2RightFile(?File $slideThreeImage2RightFile = null): void
	{
		$this->slideThreeImage2RightFile = $slideThreeImage2RightFile;

		if (null !== $slideThreeImage2RightFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideThreeImage2RightFile(): ?File
	{
		return $this->slideThreeImage2RightFile;
	}

	public function getSlideThreeImage3Left(): ?string
	{
		return $this->slideThreeImage3Left ?: 'default.png';
	}

	public function setSlideThreeImage3Left(?string $slideThreeImage3Left): self
	{
		$this->slideThreeImage3Left = $slideThreeImage3Left;

		return $this;
	}

	public function setSlideThreeImage3LeftFile(?File $slideThreeImage3LeftFile = null): void
	{
		$this->slideThreeImage3LeftFile = $slideThreeImage3LeftFile;

		if (null !== $slideThreeImage3LeftFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideThreeImage3LeftFile(): ?File
	{
		return $this->slideThreeImage3LeftFile;
	}

	public function getSlideThreeImage4Right(): ?string
	{
		return $this->slideThreeImage4Right ?: 'default.png';
	}

	public function setSlideThreeImage4Right(?string $slideThreeImage4Right): self
	{
		$this->slideThreeImage4Right = $slideThreeImage4Right;

		return $this;
	}

	public function setSlideThreeImage4RightFile(?File $slideThreeImage4RightFile = null): void
	{
		$this->slideThreeImage4RightFile = $slideThreeImage4RightFile;

		if (null !== $slideThreeImage4RightFile) {
			$this->updatedAt = new \DateTimeImmutable();
		}
	}

	public function getSlideThreeImage4RightFile(): ?File
	{
		return $this->slideThreeImage4RightFile;
	}
}
