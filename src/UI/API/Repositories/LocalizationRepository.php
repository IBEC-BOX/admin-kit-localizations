<?php

declare(strict_types=1);

namespace AdminKit\Localizations\UI\API\Repositories;

use AdminKit\Core\Abstracts\Repositories\AbstractRepository;
use AdminKit\Localizations\Models\Localization;

/**
 * @method Localization model()
 */
class LocalizationRepository extends AbstractRepository implements LocalizationRepositoryInterface
{
    public function getModelClass(): string
    {
        return Localization::class;
    }

    public function getFullList(): array
    {
        return $this->model()
            ->select(['key', 'content'])
            ->get()
            ->toArray();
    }

    public function getList($locale): array
    {
        return $this->model()
            ->selectRaw("key, content->'$locale' as content")
            ->get()
            ->toArray();
    }
}
