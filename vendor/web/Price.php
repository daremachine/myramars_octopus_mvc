<?php declare(strict_types=1);

class Price
{
    public $id;
    public $description;
    public $currency;
    public $price;
    public $priceFull;

    public function __construct(int $id, string $description, string $currency, int $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->currency = $currency;
        $this->price = $price;
        $this->priceFull = "{$price} {$currency}";
    }
}