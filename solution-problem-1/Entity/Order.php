<?php

namespace Entity;

use Models\Discounts\Manager;

class Order implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $customerId;

    /**
     * @var \Entity\Product[]
     */
    private $items = [];

    public function __construct($data = NULL)
    {
        if ($data !== NULL) {
            $this->setDataFromJson($data);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return \Entity\Product[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param \Entity\Product[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @param \Entity\Product $item
     */
    public function addItem($item)
    {
        $this->items[] = $item;
    }

    /**
     * @param string $data Order data as json
     */
    public function setDataFromJson($data)
    {
        $dataFromJson = json_decode($data, TRUE);

        $this->setId((int)$dataFromJson['id']);
        $this->setCustomerId((int)$dataFromJson['customer-id']);

        foreach ($dataFromJson['items'] as $itemArray) {
            $product = (new ProductRepository())->getProductById($itemArray['product-id']);
            $product->setQuantity((int)$itemArray['quantity']);

            $this->addItem($product);
        }
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return Manager::getTotalDiscount($this);
    }

    /**
     * @return float Total price before discounts
     */
    public function getRawPrice()
    {
        return array_reduce(
            $this->getItems(),
            function ($carry, $product) {
                /* @var $product \Entity\Product */
                return $carry + $product->getTotalPrice();
            },
            0
        );
    }

    /**
     * @return float Total pride with discounts
     */
    public function getTotalPrice()
    {
        return $this->getRawPrice() - $this->getDiscount();
    }

    public function jsonSerialize()
    {
        $discount = $this->getDiscount();
        $totalBeforeDiscount = $this->getRawPrice();

        $items = [];
        foreach ($this->getItems() as $item) {
            $items[] = [
                'product-id' => $item->getId(),
                'quantity' => $item->getQuantity(),
                'unit-price' => $item->getUnitPrice(),
                'total' => $item->getTotalPrice(),
            ];
        }

        return [
            'id' => $this->getId(),
            'customer-id' => $this->getCustomerId(),
            'items' => $items,
            'total-before-discount' => $totalBeforeDiscount,
            'discount' => $discount,
            'total' => $totalBeforeDiscount - $discount,
        ];
    }
}
