<?php

namespace Entity;

class Product
{
    /**
     * @var string
     */
    private $id;

    /**
     * Normally you should use integer to store cents, but for the simplicity I'll use a float
     * @var float
     */
    private $unitPrice;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var int
     */
    private $category;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return float Total price of the product(s)
     */
    public function getTotalPrice()
    {
        return $this->getUnitPrice() * $this->getQuantity();
    }
}
