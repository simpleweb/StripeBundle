<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    FOS\UserBundle\Model\UserManagerInterface,
    Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class AbstractStripeListener implements EventSubscriberInterface
{
    /**
     * @var UserManagerInterface
     */
    protected $user_manager;

    public function __construct(UserManagerInterface $user_manager)
    {
        $this->user_manager = $user_manager;
    }

    /**
     * @param string $customer_id
     *
     * @return UserInterface
     */
    protected function findUserByStripeCustomerId($customer_id)
    {
        return $this->user_manager->findUserBy(array(
            'stripe_customer_id' => $customer_id
        ));
    }
}
