<?php

namespace App\Serializer\Subscriber;

use App\Entity\Product;
use App\Util\BrandType;
use App\Util\OffPrice;
use JMS\Serializer\Context;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Metadata\StaticPropertyMetadata;

class ProductSubscriber implements EventSubscriberInterface
{

    /**
     * Returns the events to which this class has subscribed.
     *
     * Return format:
     *     array(
     *         array('event' => 'the-event-name', 'method' => 'onEventName', 'class' => 'some-class', 'format' => 'json'),
     *         array(...),
     *     )
     *
     * The class may be omitted if the class wants to subscribe to events of all classes.
     * Same goes for the format key.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.post_serialize',
                'method' => 'onPostSerialize',
                'class' => Product::class,
                'format' => 'json',
            ],
        ];
    }

    /**
     * @param Context $context
     * @param string $group
     *
     * @return bool
     */
    private function isGroupActive(Context $context, string $group): bool
    {
        $groups = $context->hasAttribute('groups') ? $context->getAttribute('groups') : [];

        return in_array($group, $groups);
    }

    /**
     * @param JsonSerializationVisitor $visitor
     * @param string $key
     * @param $value
     */
    private function addData(JsonSerializationVisitor $visitor, string $key, $value)
    {
        $visitor->visitProperty(new StaticPropertyMetadata('', $key, $value), $value);
    }

    /**
     * @param ObjectEvent $event
     * @throws \ReflectionException
     */
    public function onPostSerialize(ObjectEvent $event)
    {
        /** @var Product $product */
        $product = $event->getObject();
        $context = $event->getContext();

        /** @var JsonSerializationVisitor $visitor */
        $visitor = $event->getVisitor();

        // Add brand node
        $this->addData($visitor, 'brand', [
            'id' => $product->getBrand(),
            'name' => BrandType::getName($product->getBrand()),
        ]);

        // Add price node
        $this->addData($visitor, 'price', OffPrice::getPrice($product->getBrand(), $product->getPrice()));

        // Add stock node
        if ($this->isGroupActive($context, 'product_stock')) {
            $this->addData($visitor, 'stock', 100);
        }
    }
}