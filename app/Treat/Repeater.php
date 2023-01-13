<?php

namespace App\Treat;

trait Repeater
{
    public array $repeater = [1];

    public function addRow(): void
    {
        $this->repeater[] = +1;
        $this->productunit[] = +null;
        $this->productCategory[] = +null;
        $this->total[] = +0;
    }

    public function removeRow($key): void
    {
        if (isset($this->repeater[$key]))
            unset($this->repeater[$key]);
        if (isset($this->productunit[$key]))
            unset($this->productunit[$key]);
        if (isset($this->productCategory[$key]))
            unset($this->productCategory[$key]);
        if (isset($this->product_id[$key]))
            unset($this->product_id[$key]);
        if (isset($this->price[$key]))
            unset($this->price[$key]);
        if (isset($this->quantity[$key]))
            unset($this->quantity[$key]);
        if (isset($this->total[$key]))
            unset($this->total[$key]);
        if (isset($this->productAvailable[$key]))
            unset($this->productAvailable[$key]);

    }

}
