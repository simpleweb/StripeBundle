<?php

namespace Simpleweb\StripeBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\EventDispatcher\Event;

/**
 * Stripe event wrapper, fired by the webhook event dispatcher and also
 * persisted by Doctrine, since we provide checks to mitigate replay-attacks.
 *
 * @ORM\Entity
 * @ORM\Table(name="stripe__events")
 */
class StripeEvent extends Event
{
    use Traits\Timestampable;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(length = 50)
     */
    protected $id;

    /**
     * @ORM\Column(length = 50)
     */
    protected $type;

    /**
     * @ORM\Column(type = "datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type = "object")
     */
    protected $event;

    /**
     * @ORM\Column(type = "object")
     */
    protected $data;

    /**
     * @ORM\Column(type = "object")
     */
    protected $subject;

    /**
     * @param \Stripe_Event $event
     */
    public static function create(\Stripe_Event $stripe)
    {
        $event = new self;

        $event
            ->setId($stripe->id)
            ->setType($stripe->type)
            ->setDate(new \DateTime($stripe->date))
            ->setEvent($stripe)
        ;

        if ($stripe->data) {
            $event->setData($stripe->data);

            if ($stripe->data->object) {
                $event->setSubject($stripe->data->object);
            }
        }

        return $event;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Event
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'simpleweb_stripe.' . $this->getType();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Event
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return \Stripe_Event $event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param \Stripe_Event $subject
     *
     * @return Event
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param object $data
     *
     * @return Event
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return \Stripe_Object|null $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param \Stripe_Object|null $subject
     *
     * @return Event
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}
