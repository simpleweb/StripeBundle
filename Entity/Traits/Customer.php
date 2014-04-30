<?php

namespace Simpleweb\StripeBundle\Entity\Traits;

trait Customer
{
    /**
     * @ORM\Column(nullable = true)
     */
    protected $stripe_card_id;

    /**
     * @ORM\Column(length = 4, nullable = true)
     */
    protected $stripe_card_last4;

    /**
     * @ORM\Column(length = 20, nullable = true)
     */
    protected $stripe_card_type;

    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $stripe_card_exp_month;

    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $stripe_card_exp_year;

    /**
     * @ORM\Column(type = "boolean")
     */
    protected $stripe_customer_active = false;

    /**
     * @ORM\Column(nullable = true)
     */
    protected $stripe_customer_id;

    /**
     * Update the User based on a \Stripe_Card
     *
     * NB: activates/deactivates the customer
     *
     * @param \Stripe_Card|null $card
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCard(\Stripe_Card $card = null)
    {
        return $this
            ->setStripeCardId($card ? $card->id : null)
            ->setStripeCardLast4($card ? $card->last4 : null)
            ->setStripeCardType($card ? $card->type : null)
            ->setStripeCardExpiryMonth($card ? $card->exp_month : null)
            ->setStripeCardExpiryYear($card ? $card->exp_year : null)
            ->setStripeCustomerActive(!!$card)
        ;
    }

    /**
     * @return string
     */
    public function getStripeCardId()
    {
        return $this->stripe_card_id;
    }

    /**
     * @param string $stripe_card_id
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCardId($stripe_card_id)
    {
        $this->stripe_card_id = $stripe_card_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getStripeCardLast4()
    {
        return $this->stripe_card_last4;
    }

    /**
     * @param string $stripe_card_last4
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCardLast4($stripe_card_last4)
    {
        $this->stripe_card_last4 = $stripe_card_last4;

        return $this;
    }

    /**
     * @return string
     */
    public function getStripeCardType()
    {
        return $this->stripe_card_type;
    }

    /**
     * @param string $stripe_card_type
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCardType($stripe_card_type)
    {
        $this->stripe_card_type = $stripe_card_type;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStripeCardExpiresAt()
    {
        if ($this->getStripeCardExpiryMonth() && $this->getStripeCardExpiryYear()) {
            return new \DateTime(sprintf(
                '%d-%d last day of this month 11:59:59',
                $this->getStripeCardExpiryYear(),
                $this->getStripeCardExpiryMonth()
            ));
        }
    }

    /**
     * @return integer
     */
    public function getStripeCardExpiryMonth()
    {
        return $this->stripe_card_exp_month;
    }

    /**
     * @param integer $stripe_card_exp_month
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCardExpiryMonth($stripe_card_exp_month)
    {
        $this->stripe_card_exp_month = $stripe_card_exp_month;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStripeCardExpiryYear()
    {
        return $this->stripe_card_exp_year;
    }

    /**
     * @param integer $stripe_card_exp_year
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCardExpiryYear($stripe_card_exp_year)
    {
        $this->stripe_card_exp_year = $stripe_card_exp_year;

        return $this;
    }

    /**
     * Update the User based on a \Stripe_Customer
     *
     * NB: deactivates the customer if null is passed
     *
     * @param \Stripe_Customer|null $customer
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCustomer(\Stripe_Customer $customer = null)
    {
        return $this
            ->setStripeCustomerActive($customer ? $this->isStripeCustomerActive() : false)
            ->setStripeCustomerId($customer ? $customer->id : null)
            ->setStripeCard($customer ? $customer->cards->retrieve($customer->default_card) : null)
        ;
    }

    /**
     * @return boolean
     */
    public function isStripeCustomerActive()
    {
        return $this->stripe_customer_active;
    }

    /**
     * @param boolean $stripe_customer_active
     *
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
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setStripeCustomerId($stripe_customer_id)
    {
        $this->stripe_customer_id = $stripe_customer_id;

        return $this;
    }
}
