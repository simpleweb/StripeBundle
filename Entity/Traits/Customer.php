<?php

namespace Simpleweb\StripeBundle\Entity\Traits;

trait Customer
{
    /**
     * @ORM\Column(nullable = true)
     */
    protected $stripe_customer_id;

    /**
     * @return string
     */
    public function getStripeCustomerId()
    {
        return $this->stripe_customer_id;
    }

    /**
     * @param string $stripe_customer_id
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCustomerId($stripe_customer_id)
    {
        $this->stripe_customer_id = $stripe_customer_id;

        return $this;
    }
}
