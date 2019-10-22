<?php

namespace Imoisey\Cross;

interface ProviderInterface
{
    /**
     * Возвращает массив коллекций, которые будут проверяться на пересечения
     *
     * @return CollectionInterface[]
     */
    public function getCollections();
}
