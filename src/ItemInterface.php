<?php

namespace Imoisey\Cross;

/**
 * Интерфейс для элементов, которые будут проверяться
 */
interface ItemInterface
{
    /**
     * Возвращет проверяемый период
     *
     * @return \DatePeriod
     */
    public function getPeriod();
}
