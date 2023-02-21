<?php

namespace spicyweb\entrytypefields\collections;

use Illuminate\Support\Collection;

/**
 * A Collection containing entry types.
 *
 * @package spicyweb\entrytypefields\collections
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
class EntryTypesCollection extends Collection
{
    /**
     * Gets the IDs for the entry types in this collection.
     *
     * @return Collection
     */
    public function ids(): Collection
    {
        return $this->map(fn($entryType) => $entryType->id);
    }
}
