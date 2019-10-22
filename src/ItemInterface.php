<?php

namespace Imoisey\Cross;

interface Item
{
    /**
     * Возвращет проверяемый период
     *
     * @return \DatePeriod
     */
    public function getPeriod();
}
