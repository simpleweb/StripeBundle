<?php

namespace Simpleweb\StripeBundle\EventListener;

use FOS\UserBundle\Model\UserInterface,
    FOS\UserBundle\Model\UserManagerInterface,
    Simpleweb\StripeBundle\Entity\StripeEvent,
    Simpleweb\StripeBundle\StripeEvents,
    Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WebhookListener implements EventSubscriberInterface
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
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            StripeEvents::CHARGE_FAILED          => 'onChargeFailed',
            StripeEvents::INVOICE_CREATED => 'onInvoicePaymentFailed'
        );
    }

    public function onChargeFailed(StripeEvent $event)
    {
        $charge = $event->getSubject();

        $user = $this->findUserByStripeCustomerId($charge->card->customer);

        if ($user) {
            $this->deactivateCustomer($user);
        }
    }

    public function onInvoicePaymentFailed(StripeEvent $event)
    {
        $invoice = $event->getSubject();

        $user = $this->findUserByStripeCustomerId($invoice->customer);

        if ($user) {
            $this->deactivateCustomer($user);
        }
    }

    /**
     * @param UserInterface
     */
    protected function activateCustomer(UserInterface $user)
    {
        $user->setStripeCustomerActive(true);

        $this->user_manager->updateUser($user);
    }

    /**
     * @param UserInterface
     */
    protected function deactivateCustomer(UserInterface $user)
    {
        $user->setStripeCustomerActive(false);

        $this->user_manager->updateUser($user);
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
