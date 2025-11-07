<?php

namespace App\Service\Slugger;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class SluggerService
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * À toi d'implémenter :
     * - transformation d’un texte en slug
     * - gestion des collisions
     * - fallback si vide
     */
    public function makeSlug(object $entity, string $source): string
    {
        if (!$source || trim($source) === '') {
            $source = substr(bin2hex(random_bytes(4)), 0, 8);
        }

        $slugger = new AsciiSlugger('fr');
        $slug = strtolower($slugger->slug($source)->toString());
        $slug = substr($slug, 0, 150);

        $repo = $this->em->getRepository($entity::class);
        $forbidden = ['admin', 'api', 'login', 'register'];

        if (in_array($slug, $forbidden, true)) {
            $slug .= '-page';
        }

        $i = 0;
        $uniqueSlug = $slug;

        while (($existing = $repo->findOneBy(['slug' => $uniqueSlug])) && $existing !== $entity) {
            $i++;
            $uniqueSlug = $slug . '-' . $i;
        }

        return $uniqueSlug;
    }

}
