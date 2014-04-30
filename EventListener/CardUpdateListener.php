<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents;

class CardUpdateListener extends AbstractStripeListener
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::CUSTOMER_CARD_UPDATED => 'onCardUpdated'
        );
    }

    public function onCardUpdated(StripeEvent $event)
    {
        $card = $event->getSubject();

        $user = $this->findUserByStripeCardId($card->id);

        if ($user) {
            $user->setStripeCard($card);

            $this->user_manager->updateUser($user);
        }
    }
}
