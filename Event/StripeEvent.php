<?php

namespace Simpleweb\StripeBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class StripeEvent extends Event
{
    protected $event;

    protected $subject;

    /**
     * @param \Stripe_Event $event
     * @param \Stripe_Object|null $subject
     */
    public function __construct(\Stripe_Event $event, \Stripe_Object $subject = null)
    {
        $this->event = $event;
        $this->subject = $subject;
    }

    /**
     * @return \Stripe_Event $event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return \Stripe_Object|null $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
