<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents;

class CustomerUpdateListener extends AbstractStripeListener
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::CUSTOMER_UPDATED => 'onCustomerUpdated'
        );
    }

    public function onCustomerUpdated(StripeEvent $event)
    {
        $customer = $event->getSubject();

        $user = $this->findUserByStripeCustomerId($customer->id);

        // if found and default card has changed, save it and reactivate the customer
        if ($user && $customer->default_card != $user->getStripeCardId()) {
            $user->setStripeCustomer($customer);

            $this->user_manager->updateUser($user);
        }
    }
}
