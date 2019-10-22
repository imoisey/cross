<?php

namespace Imoisey\Cross;

use Imoisey\Cross\ItemInterface;

interface Collection
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
