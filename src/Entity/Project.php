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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title4Fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title4En;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title4Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text4Fr;

	/**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text4En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text4Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title5Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title5En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title5Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text5Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text5En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text5Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title6Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title6En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title6Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text6Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text6En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text6Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title7Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title7En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title7Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text7Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text7En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text7Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title8Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title8En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $title8Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text8Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text8En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text8Ko;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text9Fr;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text9En;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default": "Lorem ipsum dolor sit amet"})
     */
    private $text9Ko;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $color1;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $color2;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $color3;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $color4;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $color5;

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
 
    /**
     * Get the French title for section 4.
     *
     * @return string|null The French title for section 4, or null if not set.
     */
    public function getTitle4Fr(): ?string
    {
        return $this->title4Fr ?? 'Titre 4';
    }

    /**
     * Set the French title for section 4.
     *
     * @param string|null $value The new French title for section 4.
     * @return self Returns the current instance for method chaining.
     */
    public function setTitle4Fr(?string $value): self
    {
        $this->title4Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    /**
     * Get the English title for section 4.
     *
     * @return string|null The English title for section 4, or null if not set.
     */
    public function getTitle4En(): ?string
    {
        return $this->title4En ?? 'Titre 4';
    }

    /**
     * Set the English title for section 4.
     *
     * @param string|null $value The new English title for section 4.
     * @return self Returns the current instance for method chaining.
     */
    public function setTitle4En(?string $value): self
    {
        $this->title4En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    /**
     * Get the Korean title for section 4.
     *
     * @return string|null The Korean title for section 4, or null if not set.
     */
    public function getTitle4Ko(): ?string
    {
        return $this->title4Ko ?? 'Titre 4';
    }

    /**
     * Set the Korean title for section 4.
     *
     * @param string|null $value The new Korean title for section 4.
     * @return self Returns the current instance for method chaining.
     */
    public function setTitle4Ko(?string $value): self
    {
        $this->title4Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

	public function getText4Fr(): ?string {
		return $this->text4Fr ?? 'Lorem ipsum dolor sit amet';
	}

    /**
     * Set the French text for section 4.
     *
     * @param string|null $value The new French text for section 4.
     * @return self Returns the current instance for method chaining.
     */
    public function setText4Fr(?string $value): self
    {
        $this->text4Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    /**
     * Get the English text for section 4.
     *
     * @return string|null The English text for section 4, or null if not set.
     */
    public function getText4En(): ?string
    {
        return $this->text4En ?? 'Lorem ipsum dolor sit amet';
    }

    /**
     * Set the English text for section 4.
     *
     * @param string|null $value The new English text for section 4.
     * @return self Returns the current instance for method chaining.
     */
    public function setText4En(?string $value): self
    {
        $this->text4En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    /**
     * Get the Korean text for section 4.
     *
     * @return string|null The Korean text for section 4, or null if not set.
     */
    public function getText4Ko(): ?string
    {
        return $this->text4Ko ?? 'Lorem ipsum dolor sit amet';
    }

    /**
     * Set the Korean text for section 4.
     *
     * @param string|null $value The new Korean text for section 4.
     * @return self Returns the current instance for method chaining.
     */
    public function setText4Ko(?string $value): self
    {
        $this->text4Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

	public function getTitle5Fr(): ?string {
        return $this->title5Fr ?? 'Titre 5';
    }

    public function setTitle5Fr(?string $value): self {
        $this->title5Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle5En(): ?string {
        return $this->title5En ?? 'Title 5';
    }

    public function setTitle5En(?string $value): self {
        $this->title5En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle5Ko(): ?string {
        return $this->title5Ko ?? 'Title 5';
    }

    public function setTitle5Ko(?string $value): self {
        $this->title5Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText5Fr(): ?string {
        return $this->text5Fr ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText5Fr(?string $value): self {
        $this->text5Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText5En(): ?string {
        return $this->text5En ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText5En(?string $value): self {
        $this->text5En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText5Ko(): ?string {
        return $this->text5Ko ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText5Ko(?string $value): self {
        $this->text5Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle6Fr(): ?string {
        return $this->title6Fr ?? 'Titre 6';
    }

    public function setTitle6Fr(?string $value): self {
        $this->title6Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle6En(): ?string {
        return $this->title6En ?? 'Title 6';
    }

    public function setTitle6En(?string $value): self {
        $this->title6En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle6Ko(): ?string {
        return $this->title6Ko ?? 'Title 6';
    }

    public function setTitle6Ko(?string $value): self {
        $this->title6Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText6Fr(): ?string {
        return $this->text6Fr ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText6Fr(?string $value): self {
        $this->text6Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText6En(): ?string {
        return $this->text6En ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText6En(?string $value): self {
        $this->text6En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText6Ko(): ?string {
        return $this->text6Ko ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText6Ko(?string $value): self {
        $this->text6Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle7Fr(): ?string {
        return $this->title7Fr ?? 'Title 5';
    }

    public function setTitle7Fr(?string $value): self {
        $this->title7Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle7En(): ?string {
        return $this->title7En ?? 'Title 7';
    }

    public function setTitle7En(?string $value): self {
        $this->title7En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle7Ko(): ?string {
        return $this->title7Ko ?? 'Title 7';
    }

    public function setTitle7Ko(?string $value): self {
        $this->title7Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText7Fr(): ?string {
        return $this->text7Fr ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText7Fr(?string $value): self {
        $this->text7Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText7En(): ?string {
        return $this->text7En ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText7En(?string $value): self {
        $this->text7En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText7Ko(): ?string {
        return $this->text7Ko ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText7Ko(?string $value): self {
        $this->text7Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle8Fr(): ?string {
        return $this->title8Fr ?? 'Title 8';
    }

    public function setTitle8Fr(?string $value): self {
        $this->title8Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle8En(): ?string {
        return $this->title8En ?? 'Title 8';
    }

    public function setTitle8En(?string $value): self {
        $this->title8En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getTitle8Ko(): ?string {
        return $this->title8Ko ?? 'Title 8';
    }

    public function setTitle8Ko(?string $value): self {
        $this->title8Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText8Fr(): ?string {
        return $this->text8Fr ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText8Fr(?string $value): self {
        $this->text8Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText8En(): ?string {
        return $this->text8En ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText8En(?string $value): self {
        $this->text8En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText8Ko(): ?string {
        return $this->text8Ko ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText8Ko(?string $value): self {
        $this->text8Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText9Fr(): ?string {
        return $this->text9Fr ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText9Fr(?string $value): self {
        $this->text9Fr = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText9En(): ?string {
        return $this->text9En ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText9En(?string $value): self {
        $this->text9En = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

    public function getText9Ko(): ?string {
        return $this->text9Ko ?? 'Lorem ipsum dolor sit amet';
    }

    public function setText9Ko(?string $value): self {
        $this->text9Ko = $value ?? 'Lorem ipsum dolor sit amet';
        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getColor1()
	{
		return $this->color1;
	}

	/**
	 * @param mixed $color1
	 */
	public function setColor1($color1): void
	{
		$this->color1 = $color1;
	}

	/**
	 * @return mixed
	 */
	public function getColor2()
	{
		return $this->color2;
	}

	/**
	 * @param mixed $color2
	 */
	public function setColor2($color2): void
	{
		$this->color2 = $color2;
	}

	/**
	 * @return mixed
	 */
	public function getColor3()
	{
		return $this->color3;
	}

	/**
	 * @param mixed $color3
	 */
	public function setColor3($color3): void
	{
		$this->color3 = $color3;
	}

	/**
	 * @return mixed
	 */
	public function getColor4()
	{
		return $this->color4;
	}

	/**
	 * @param mixed $color4
	 */
	public function setColor4($color4): void
	{
		$this->color4 = $color4;
	}

	/**
	 * @return mixed
	 */
	public function getColor5()
	{
		return $this->color5;
	}

	/**
	 * @param mixed $color5
	 */
	public function setColor5($color5): void
	{
		$this->color5 = $color5;
	}
}
