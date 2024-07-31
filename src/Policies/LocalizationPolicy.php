<?php

namespace AdminKit\Localizations\Policies;

use App\Models\AdminKitUser;
use AdminKit\Localizations\Models\Localization;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocalizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the adminKitUser can view any models.
     */
    public function viewAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('view_any_localization');
    }

    /**
     * Determine whether the adminKitUser can view the model.
     */
    public function view(AdminKitUser $adminKitUser, Localization $localization): bool
    {
        return $adminKitUser->can('view_localization');
    }

    /**
     * Determine whether the adminKitUser can create models.
     */
    public function create(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('create_localization');
    }

    /**
     * Determine whether the adminKitUser can update the model.
     */
    public function update(AdminKitUser $adminKitUser, Localization $localization): bool
    {
        return $adminKitUser->can('update_localization');
    }

    /**
     * Determine whether the adminKitUser can delete the model.
     */
    public function delete(AdminKitUser $adminKitUser, Localization $localization): bool
    {
        return $adminKitUser->can('delete_localization');
    }

    /**
     * Determine whether the adminKitUser can bulk delete.
     */
    public function deleteAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('delete_any_localization');
    }

    /**
     * Determine whether the adminKitUser can permanently delete.
     */
    public function forceDelete(AdminKitUser $adminKitUser, Localization $localization): bool
    {
        return $adminKitUser->can('force_delete_localization');
    }

    /**
     * Determine whether the adminKitUser can permanently bulk delete.
     */
    public function forceDeleteAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('force_delete_any_localization');
    }

    /**
     * Determine whether the adminKitUser can restore.
     */
    public function restore(AdminKitUser $adminKitUser, Localization $localization): bool
    {
        return $adminKitUser->can('restore_localization');
    }

    /**
     * Determine whether the adminKitUser can bulk restore.
     */
    public function restoreAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('restore_any_localization');
    }

    /**
     * Determine whether the adminKitUser can replicate.
     */
    public function replicate(AdminKitUser $adminKitUser, Localization $localization): bool
    {
        return $adminKitUser->can('replicate_localization');
    }

    /**
     * Determine whether the adminKitUser can reorder.
     */
    public function reorder(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('reorder_localization');
    }
}
