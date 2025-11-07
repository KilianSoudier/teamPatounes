<?php

namespace App\Contract;

interface SluggableInterface
{
    public function getSlug(): ?string;
    public function setSlug(string $slug): static;

    public function getSlugSource(): ?string;
}
