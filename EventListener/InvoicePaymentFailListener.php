<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents;

class InvoicePaymentFailListener extends AbstractStripeListener
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::INVOICE_PAYMENT_FAILED => 'onInvoicePaymentFailed'
        );
    }

    public function onInvoicePaymentFailed(StripeEvent $event)
    {
        $invoice = $event->getSubject();

        $user = $this->findUserByStripeCustomerId($invoice->customer);

        if ($user && $invoice->closed) {
            $user->setStripeCustomerActive(false);

            $this->user_manager->updateUser($user);
        }
    }
}
