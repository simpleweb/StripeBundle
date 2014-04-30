<?php

namespace Simpleweb\StripeBundle\EntityListener;

use FOS\UserBundle\Model\UserInterface,
    Doctrine\ORM\Event\PreUpdateEventArgs;

class UserListener
{
    public function preUpdate(UserInterface $user, PreUpdateEventArgs $event)
    {
        if ($user->getStripeCustomerId()) {
            $customer = \Stripe_Customer::retrieve($user->getStripeCustomerId());

            $customer->email = $user->getEmail();

            $customer->save();
        }
    }
}
