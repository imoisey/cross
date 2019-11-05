<?php

namespace Imoisey\Cross\Collection;

use Imoisey\Cross\ItemInterface;
use PhpCollection\Sequence;

/**
 * Абстрактная коллекция.
 * Хранит в себе однотипные элементы, которые нужно проверять на пересечения.
 */
abstract class Collection extends Sequence implements CollectionInterface
{
    /** @var ItemInteface[] */
    protected $collision = [];

    public function __construct(array $items = [])
    {
        $this->addAll($items);
    }

    /**
     * Добавляет элемент в коллекцию.
     *
     * @param ItemIterface $item
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function add($item)
    {
        if ($item instanceof ItemInterface) {
            parent::add($item);

            return;
        }

        throw new \InvalidArgumentException('Item does not implement the interface ItemInterface');
    }

    /**
     * Добавляет массив элеменов в коллекцию.
     *
     * @param ItemIterface[] $items
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function addAll(array $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Выполняет проверку перечений внутри коллекции.
     *
     * @return bool
     */
    public function verify()
    {
        $this->collision = [];

        for ($a = 0; $a < $this->count(); $a++) {
            $itemA = $this->get($a);
            $periodA = $itemA->getPeriod();
            for ($b = $a + 1; $b < $this->count(); $b++) {
                $itemB = $this->get($b);
                $periodB = $itemB->getPeriod();

                if ($this->isNotCrossPeriods($periodA, $periodB)) {
                    continue;
                }

                if (!in_array($itemA, $this->collision, true)) {
                    $this->collision[] = $itemA;
                }

                if (!in_array($itemB, $this->collision, true)) {
                    $this->collision[] = $itemB;
                }
            }
        }

        return empty($this->collision) ? false : true;
    }

    /**
     * Возвращает элементы коллекции, которые пересекаются.
     *
     * @return ItemInterface[]
     */
    public function getCollision()
    {
        return $this->collision;
    }

    /**
     * Проверяет пересечение 2х периодов
     * Возвращает true, если они пересекаются.
     *
     * @param \DatePeriod $periodA
     * @param \DatePeriod $periodB
     *
     * @return bool
     */
    protected function isCrossPeriods(\DatePeriod $periodA, \DatePeriod $periodB)
    {
        $beginA = $periodA->start->getTimestamp();
        $beginB = $periodB->start->getTimestamp();

        $endA = $periodA->end->getTimestamp();
        $endB = $periodB->end->getTimestamp();

        return min($endA, $endB) - max($beginA, $beginB) > 0;
    }

    /**
     * Проверяет пересечение 2х периодов
     * Возвращает true, если они НЕ пересекаются.
     *
     * @param \DatePeriod $periodA
     * @param \DatePeriod $periodB
     *
     * @return bool
     */
    protected function isNotCrossPeriods(\DatePeriod $periodA, \DatePeriod $periodB)
    {
        return $this->isCrossPeriods($periodA, $periodB) == false;
    }
}
