<?php

namespace Simpleweb\StripeBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class StripeEvent extends Event
{
    protected $event;

    protected $data;

    /**
     * @param \Stripe_Event $event
     * @param \Stripe_Object|null $data
     */
    public function __construct(\Stripe_Event $event, \Stripe_Object $data = null)
    {
        $this->event = $event;
        $this->data = $data;
    }

    /**
     * @return \Stripe_Event $event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return \Stripe_Object|null $data
     */
    public function getData()
    {
        return $this->data;
    }
}
