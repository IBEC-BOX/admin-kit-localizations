<?php

declare(strict_types=1);

namespace AdminKit\Localizations\UI\API\Repositories;

use Illuminate\Support\Facades\Cache;

class CachedLocalizationRepository implements LocalizationRepositoryInterface
{
    public function __construct(
        private readonly LocalizationRepository $repository
    ) {}

    public function getFullList(): array
    {
        $key = 'ak_localizations';

        return Cache::remember($key, config('admin-kit.cache.ttl'), function () {
            return $this->repository->getFullList();
        });
    }

    public function getList($locale): array
    {
        $key = "ak_localizations_$locale";

        return Cache::remember($key, config('admin-kit.cache.ttl'), function () use ($locale) {
            return $this->repository->getList($locale);
        });
    }
}
