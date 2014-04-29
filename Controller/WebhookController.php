<?php

namespace Simpleweb\StripeBundle\Controller;

use Simpleweb\StripeBundle\Event\StripeEvent,
    Symfony\Component\DependencyInjection\ContainerAware,
    Symfony\Component\HttpFoundation\Response;

class WebhookController extends ContainerAware
{
    public function eventAction()
    {
        $request = $this->container->get('request');

        $content = json_decode($request->getContent());

        if ($content) {
            $event = $content->type;
            $data = $content->data->object;

            if ($event && $data) {
                $dispatcher = $this->container->get('event_dispatcher');
                $dispatcher->dispatch(sprintf('simpleweb_stripe.%s', $event), new StripeEvent($data));
            } else {
                throw new \Exception('The request body did not contain an event and associated data object.');
            }
        } else {
            throw new \Exception('The request body could not be parsed.');
        }

        return new Response(null, 200);
    }
}
