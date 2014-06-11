<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents;

class InvoiceCreatedVatListener extends AbstractStripeListener
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::INVOICE_CREATED => 'onInvoiceCreatedAddVat'
        );
    }

    public function onInvoiceCreatedAddVat(StripeEvent $event)
    {
        $vat_rate = 20;
        $invoice = $event->getSubject();
        $user = $this->findUserByStripeCustomerId($invoice->customer);
        $subscription = $user->getSubscription();
        $vat_amount = ($vat_rate / 100) * $invoice->total;

        \Stripe_InvoiceItem::create([
            'customer'     => $invoice->customer,
            'amount'       => $vat_amount,
            'currency'     => $subscription->getCurrency()->getCode(),
            'invoice'      => $invoice->id,
            'description'  => "VAT Total @ ${vat_rate}%",
            'metadata'     => [
                'vat_rate' => $vat_rate
            ]
        ]);
    }
}
