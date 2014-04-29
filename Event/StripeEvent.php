<?php

namespace Simpleweb\StripeBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class StripeEvent extends Event
{
    protected $data;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return $data
     */
    public function getData()
    {
        return $this->data;
    }
}
