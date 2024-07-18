<?php

declare(strict_types=1);

namespace AdminKit\Localizations\UI\API\Repositories;

interface LocalizationRepositoryInterface
{
    public function getFullList(): array;

    public function getList(string $locale): array;
}
