<?php

namespace App\Entity\Traits;

trait SluggableTrait
{
    public function setSlug(string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }
}
