<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Products;

/**
 * ProductFiles
 *
 * @ORM\Table(name="product_files")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductFilesRepository")
 */
class ProductFiles
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
     * @var bool
     *
     * @ORM\Column(name="isFirst", type="boolean")
     */
    private $isFirst;

    /**
     * Many ProductFiles have One Product.
     * @ORM\ManyToOne(targetEntity="Products", inversedBy="productFiles")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /////////////////////////////////////////

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
     * @return ProductFiles
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
     * Set isFirst
     *
     * @param boolean $isFirst
     *
     * @return ProductFiles
     */
    public function setIsFirst($isFirst)
    {
        $this->isFirst = $isFirst;

        return $this;
    }

    /**
     * Get isFirst
     *
     * @return boolean
     */
    public function getIsFirst()
    {
        return $this->isFirst;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Products $product
     *
     * @return ProductFiles
     */
    public function setProduct(\AppBundle\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }
}
