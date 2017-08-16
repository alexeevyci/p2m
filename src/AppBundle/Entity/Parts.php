<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\ProductFiles;

/**
 * Parts
 *
 * @ORM\Table(name="parts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartsRepository")
 */
class Parts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime", nullable=true)
     */
    private $updateAt;


    /**
     * One Part has Many ProductFiles.
     * @ORM\OneToMany(targetEntity="ProductFiles", mappedBy="part")
     */
    private $productFiles;


    ////////////////////////////////

    public function __construct() {
        $this->productFiles = new ArrayCollection();
    }

    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    ////////////////////////////////


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Parts
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Parts
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Parts
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Add productFile
     *
     * @param \AppBundle\Entity\ProductFiles $productFile
     *
     * @return Parts
     */
    public function addProductFile(\AppBundle\Entity\ProductFiles $productFile)
    {
        $this->productFiles[] = $productFile;

        return $this;
    }

    /**
     * Remove productFile
     *
     * @param \AppBundle\Entity\ProductFiles $productFile
     */
    public function removeProductFile(\AppBundle\Entity\ProductFiles $productFile)
    {
        $this->productFiles->removeElement($productFile);
    }

    /**
     * Get productFiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductFiles()
    {
        return $this->productFiles;
    }
}
