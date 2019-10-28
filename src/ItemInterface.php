<?php

namespace Imoisey\Cross;

interface ItemInterface
{
    /**
     * Возвращет проверяемый период.
     *
     * @return \DatePeriod
     */
    public function getPeriod();
}
