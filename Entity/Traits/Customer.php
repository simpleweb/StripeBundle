<?php

namespace Simpleweb\StripeBundle\Entity\Traits;

trait Customer
{
    /**
     * @ORM\Column(length = 4, nullable = true)
     */
    protected $card_last4;

    /**
     * @ORM\Column(length = 20, nullable = true)
     */
    protected $card_type;

    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $card_exp_month;

    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $card_exp_year;

    /**
     * @ORM\Column(type = "boolean")
     */
    protected $stripe_customer_active = false;

    /**
     * @ORM\Column(nullable = true)
     */
    protected $stripe_customer_id;

    /**
     * @return string
     */
    public function getCardLast4()
    {
        return $this->card_last4;
    }

    /**
     * @param string $card_last4
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setCardLast4($card_last4)
    {
        $this->card_last4 = $card_last4;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->card_type;
    }

    /**
     * @param string $card_type
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setCardType($card_type)
    {
        $this->card_type = $card_type;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCardExpiresAt()
    {
        if ($this->getCardExpiryMonth() && $this->getCardExpiryYear()) {
            return new \DateTime(sprintf(
                '%d-%d last day of this month 11:59:59',
                $this->getCardExpiryYear(),
                $this->getCardExpiryMonth()
            ));
        }
    }

    /**
     * @return integer
     */
    public function getCardExpiryMonth()
    {
        return $this->card_exp_month;
    }

    /**
     * @param integer $card_exp_month
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setCardExpiryMonth($card_exp_month)
    {
        $this->card_exp_month = $card_exp_month;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCardExpiryYear()
    {
        return $this->card_exp_year;
    }

    /**
     * @param integer $card_exp_year
     *
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function setCardExpiryYear($card_exp_year)
    {
        $this->card_exp_year = $card_exp_year;

        return $this;
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
