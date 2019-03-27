<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BackgroundRepository")
 * @Vich\Uploadable
 */
class Background
{
    /**
     * Section type
     *
     * @var array
     */
    static $sectionTypeList = array(
        "header",
        "agenda",
        "team",
        "contact"
    );

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $section;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="backgrounds", fileNameProperty="largeName", size="largeSize")
     *
     * @var File
     */
    private $largeFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $largeName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $largeSize;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="backgrounds", fileNameProperty="mediumName", size="mediumSize")
     *
     * @var File
     */
    private $mediumFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $mediumName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $mediumSize;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="backgrounds", fileNameProperty="smallName", size="smallSize")
     *
     * @var File
     */
    private $smallFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $smallName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $smallSize;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setLargeFile(?File $largeFile = null): void
    {
        $this->largeFile = $largeFile;

        if (null !== $largeFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getLargeFile(): ?File
    {
        return $this->largeFile;
    }

    public function setLargeName(?string $largeName): void
    {
        $this->largeName = $largeName;
    }

    public function getLargeName(): ?string
    {
        return $this->largeName;
    }

    public function setLargeSize(?int $largeSize): void
    {
        $this->largeSize = $largeSize;
    }

    public function getLargeSize(): ?int
    {
        return $this->largeSize;
    }

    public function setMediumFile(?File $mediumFile = null): void
    {
        $this->mediumFile = $mediumFile;

        if (null !== $mediumFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getMediumFile(): ?File
    {
        return $this->mediumFile;
    }

    public function setMediumName(?string $mediumName): void
    {
        $this->mediumName = $mediumName;
    }

    public function getMediumName(): ?string
    {
        return $this->mediumName;
    }

    public function setMediumSize(?int $mediumSize): void
    {
        $this->mediumSize = $mediumSize;
    }

    public function getMediumSize(): ?int
    {
        return $this->mediumSize;
    }

    public function setSmallFile(?File $smallFile = null): void
    {
        $this->smallFile = $smallFile;

        if (null !== $smallFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getSmallFile(): ?File
    {
        return $this->smallFile;
    }

    public function setSmallName(?string $smalleName): void
    {
        $this->smallName = $smalleName;
    }

    public function getSmallName(): ?string
    {
        return $this->smallName;
    }

    public function setSmallSize(?int $smallSize): void
    {
        $this->smallSize = $smallSize;
    }

    public function getSmallSize(): ?int
    {
        return $this->smallSize;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
