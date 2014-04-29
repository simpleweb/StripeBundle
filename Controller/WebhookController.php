<?php

namespace Simpleweb\StripeBundle\Controller;

use Simpleweb\StripeBundle\Event\StripeEvent,
    Symfony\Component\DependencyInjection\ContainerAware,
    Symfony\Component\HttpKernel\Exception\BadRequestHttpException,
    Symfony\Component\HttpFoundation\Response;

class WebhookController extends ContainerAware
{
    public function eventAction()
    {
        $request = $this->container->get('request');

        $content = json_decode($request->getContent());

        if ($content) {
            try {
                $event = \Stripe_Event::retrieve($content->id);
            } catch (\Stripe_Error $e) {
                throw new BadRequestHttpException;
            }

            $dispatcher = $this->container->get('event_dispatcher');

            $dispatcher->dispatch(
                sprintf('simpleweb_stripe.%s', $event->type),
                new StripeEvent($event, $event->data->object)
            );
        } else {
            throw new BadRequestHttpException;
        }

        return new Response(null, 200);
    }
}
