<?php declare(strict_types=1);

class Item
{
    public $id;
    public $isActive = true;
    public $name;
    public $size;
    public $innerSize;
    public $parameters = []; // [key => val]
    public $prices = [];     // Price
    public $images = [];
    public $topItem = false;

    public function __construct(
        int $id,
        bool $isActive,
        string $name,
        string $size,
        string $innerSize,
        array $parameters,
        array $prices,
        array $images,
        bool $topItem = false)
    {
        $this->id = $id;
        $this->isActive = $isActive;
        $this->name = $name;
        $this->size = $size;
        $this->innerSize = $innerSize;
        $this->parameters = $parameters;
        $this->prices = $prices;
        $this->images = $images;
        $this->topItem = $topItem;
    }
}