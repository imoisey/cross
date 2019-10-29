<?php

namespace Imoisey\Cross\Provider;

use Imoisey\Cross\Collection\CollectionInterface;

interface ProviderInterface
{
    /**
     * Возвращает массив коллекций, которые будут проверяться на пересечения
     *
     * @return CollectionInterface[]
     */
    public function getCollections();

    /**
     * Возвращает имя провайдера
     *
     * @return string
     */
    public function getName();
}
