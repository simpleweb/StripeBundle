<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents;

class CardDeleteListener extends AbstractStripeListener
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::CUSTOMER_CARD_DELETED => 'onCardDeleted'
        );
    }

    public function onCardDeleted(StripeEvent $event)
    {
        $card = $event->getSubject();

        $user = $this->findUserByStripeCardId($card->id);

        if ($user) {
            $user->setStripeCard(null);

            $this->user_manager->updateUser($user);
        }
    }
}
