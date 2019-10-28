<?php

namespace Imoisey\Cross;

use Imoisey\Cross\Collection\CollectionInterface;

interface ProviderInterface
{
    /**
     * Возвращает массив коллекций, которые будут проверяться на пересечения
     *
     * @return CollectionInterface[]
     */
    public function getCollections();
}
