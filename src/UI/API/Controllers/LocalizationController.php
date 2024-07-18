<?php

declare(strict_types=1);

namespace AdminKit\Localizations\UI\API\Controllers;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\UI\API\Data\LocalizationData;
use AdminKit\Localizations\UI\API\Data\LocalizationFullData;
use AdminKit\Localizations\UI\API\Repositories\LocalizationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\DataCollection;

/**
 * @tags Локализация
 */
class LocalizationController extends Controller
{
    public function __construct(
        private readonly LocalizationRepositoryInterface $repository,
    ) {}

    /**
     *  Получить все переводы
     */
    public function getFullList(Request $request)
    {
        /** @deprecated in next major version, use `getLocaledList` */
        if ($locale = $request->input('locale')) {
            $request->validate([
                'locale' => ['nullable', Rule::in(AdminKit::locales())],
            ]);

            return LocalizationData::collect($this->repository->getList($locale), DataCollection::class);
        }

        return LocalizationFullData::collect($this->repository->getFullList(), DataCollection::class);
    }

    /**
     *  Получить переводы на нужном языке
     */
    public function getLocaledList($locale)
    {
        return LocalizationData::collect($this->repository->getList($locale), DataCollection::class);
    }
}
