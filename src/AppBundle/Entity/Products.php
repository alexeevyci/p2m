<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Subcategories;
use AppBundle\Entity\Statuses;


/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductsRepository")
 */
class Products
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

     /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=100)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=100)
     */
    private $brand;

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
     * Many Products have One Subcategory.
     * @ORM\ManyToOne(targetEntity="Subcategories", inversedBy="products")
     * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")
     */
    private $subcategory;

    /**
     * Many Products have One Status.
     * @ORM\ManyToOne(targetEntity="Statuses", inversedBy="products")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * One Product has Many ProductFiles.
     * @ORM\OneToMany(targetEntity="ProductFiles", mappedBy="product")
     */
    private $productFiles;


    //////////////////////////////////

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

    //////////////////////////////////



    /**
     * Get id
     *
     * @return integer
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
     * @return Products
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
     * Set year
     *
     * @param integer $year
     *
     * @return Products
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Products
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Products
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Products
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Products
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
     * @return Products
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
     * Set subcategory
     *
     * @param \AppBundle\Entity\Subcategories $subcategory
     *
     * @return Products
     */
    public function setSubcategory(\AppBundle\Entity\Subcategories $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \AppBundle\Entity\Subcategories
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Statuses $status
     *
     * @return Products
     */
    public function setStatus(\AppBundle\Entity\Statuses $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Statuses
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add productFile
     *
     * @param \AppBundle\Entity\ProductFiles $productFile
     *
     * @return Products
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
