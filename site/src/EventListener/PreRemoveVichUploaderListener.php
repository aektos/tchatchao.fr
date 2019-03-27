<?php

namespace App\EventListener;

use Vich\UploaderBundle\Event\Event;

class PreRemoveVichUploaderListener
{
    /**
     * @var null|string
     */
    private $cacheDir = null;


    public function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    public function onVichUploaderPreRemove(Event $event)
    {
        $object = $event->getObject();
//        $mapping = $event->getMapping();

        $basenames = [];
        if (property_exists($object, 'imageName') && $object->getImageName()) {

            $basenames[] = $object->getImageName();
        } elseif (property_exists($object, 'largeName')
            && property_exists($object, 'mediumName')
            && property_exists($object, 'smallName')) {

            if ($object->getLargeName()) {
                $basenames[] = $object->getLargeName();
            }
            if ($object->getMediumName()) {
                $basenames[] = $object->getMediumName();
            }
            if ($object->getSmallName()) {
                $basenames[] = $object->getSmallName();
            }
        }

        foreach ($basenames as $basename) {
            $filenamePattern = $this->cacheDir . pathinfo($basename, PATHINFO_FILENAME) . '*';
            foreach (glob($filenamePattern) as $filename) {
                unlink($filename);
            }
        }
    }

}