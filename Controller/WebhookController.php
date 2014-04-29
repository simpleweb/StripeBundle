<?php

namespace Simpleweb\StripeBundle\Controller;

use Simpleweb\StripeBundle\Entity\StripeEvent,
    Symfony\Component\DependencyInjection\ContainerAware,
    Symfony\Component\HttpKernel\Exception\BadRequestHttpException,
    Symfony\Component\HttpKernel\Exception\ConflictHttpException,
    Symfony\Component\HttpFoundation\Response;

class WebhookController extends ContainerAware
{
    public function eventAction()
    {
        $em = $this->container->get('doctrine')->getManager();
        $repository = $em->getRepository('SimplewebStripeBundle:StripeEvent');
        $request = $this->container->get('request');

        $content = json_decode($request->getContent());

        if (!$content) {
            throw new BadRequestHttpException;
        }

        if ($repository->findOneById($content->id)) {
            throw new ConflictHttpException;
        }

        try {
            $event = \Stripe_Event::retrieve($content->id);
        } catch (\Stripe_Error $e) {
            throw new BadRequestHttpException;
        }

        $this->dispatch(StripeEvent::create($event));

        return new Response(null, 200);
    }

    protected function dispatch(StripeEvent $event)
    {
        $dispatcher = $this->container->get('event_dispatcher');
        $dispatcher->dispatch($event->getName(), $event);

        $em = $this->container->get('doctrine')->getManager();
        $em->persist($event);
        $em->flush();
    }
}
