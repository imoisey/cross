<?php

namespace Imoisey\Cross\Collection;

use Imoisey\Cross\ItemInterface;

/**
 * Группирует проверяемые элементы по одному типу.
 */
interface CollectionInterface
{
    /**
     * Выполняет проверку пересечений в коллекции.
     *
     * @return bool
     */
    public function verify();

    /**
     * Возвращает элементы, которые находятся в пересечении
     *
     * @return ItemInterface[]
     */
    public function getCollision();
}
