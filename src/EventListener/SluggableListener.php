<?php

namespace App\EventListener;

use App\Contract\SluggableInterface;
use App\Service\Slugger\SluggerService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[AsDoctrineListener(event: Events::prePersist)]
#[AsDoctrineListener(event: Events::preUpdate)]
class SluggableListener
{
    public function __construct(private SluggerService $slugger) {}

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->handle($args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->handle($args);
    }

    private function handle(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof SluggableInterface) {
            return;
        }

        // Slug déjà défini → on ne régénère pas
        if ($entity->getSlug()) {
            return;
        }

        $source = $entity->getSlugSource();
        if (!$source) {
            return;
        }

        $entity->setSlug(
            $this->slugger->makeSlug($entity, $source)
        );

        // Recalcule le changeset si on est en preUpdate
        $om = $args->getObjectManager();

        if ($om instanceof EntityManagerInterface) {
            $uow = $om->getUnitOfWork();
            $class = $om->getClassMetadata($entity::class);
            $uow->recomputeSingleEntityChangeSet($class, $entity);
        }
    }
}
