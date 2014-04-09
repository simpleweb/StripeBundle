<?php

namespace Simpleweb\StripeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SimplewebStripeBundle extends Bundle
{
    public function boot()
    {
        \Stripe::setApiKey($this->container->getParameter('simpleweb_stripe.secret_key'));
    }
}
