<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents;

class CustomerDeleteListener extends AbstractStripeListener
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::CUSTOMER_DELETED => 'onCustomerDeleted'
        );
    }

    public function onCustomerDeleted(StripeEvent $event)
    {
        $customer = $event->getSubject();

        $user = $this->findUserByStripeCustomerId($customer->id);

        if ($user) {
            $user->setStripeCustomer(null);

            $this->user_manager->updateUser($user);
        }
    }
}
