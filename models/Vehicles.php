<?php declare(strict_types=1);

class Vehicles
{
    public function getCargo(int $id)
    {
        return $this->_singleOrDefault($id, $this->getCargos());
    }

    public function getCargos(): array
    {
        $cargos = [
            new Item(
                1,
                true,
                "dodavka mercedes 123",
                "v12s40d78",
                "v12s40d78",
                [
                    "Motor" => "1.2htp",
                    "Kategorie" => "C",
                    "Počet míst" => 3,
                    "Počet palet" => 6
                ],
                [
                    new Price(1, "1 den", "Kč", 1200),
                    new Price(2, "2-4 dny", "Kč", 2500),
                    new Price(3, "10-40 dny", "Kč", 14500),
                    new Price(4, "50-60 dny", "Kč", 4500)
                ],
                [
                    "images/dodavky/Iveco_Daily_17m3.jpg",
                ]
            )
        ];

        return $this->_filterActive($cargos);
    }

    /**
     * Filter active items
     */
    private function _filterActive(array $items): array
    {
        $result = [];
        foreach($items as $item)
        {
            if(!$item->isActive) continue;
            $result[] = $item;
        }

        return $result;
    }

    private function _singleOrDefault(int $id, array $items)
    {
        foreach($items as $item)
        {
            if($item->id == $id)
                return $item;
        }

        return null;
    }
}