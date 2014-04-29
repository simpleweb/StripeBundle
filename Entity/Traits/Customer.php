<?php

namespace Simpleweb\StripeBundle\Entity\Traits;

trait Customer
{
    /**
     * @ORM\Column(type = "boolean")
     */
    protected $stripe_customer_active = false;

    /**
     * @ORM\Column(nullable = true)
     */
    protected $stripe_customer_id;

    /**
     * @return boolean
     */
    public function isStripeCustomerActive()
    {
        return $this->stripe_customer_active;
    }

    /**
     * @param boolean $stripe_customer_active
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCustomerActive($stripe_customer_active)
    {
        $this->stripe_customer_active = $stripe_customer_active;

        return $this;
    }

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
