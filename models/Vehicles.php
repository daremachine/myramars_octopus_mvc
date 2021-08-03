<?php declare(strict_types=1);

///// DEMO CLASS
class Vehicles
{
    public function getCargo(int $id)
    {
        return $this->_singleOrDefault($id, $this->getCargos());
    }

    public function getCargos(): array
    {
        $cargos = [
            // ......
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