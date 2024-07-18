<?php

return [
    /**
     * Custom filesystems.disks.localizations config
     */
    'localizations' => [
        'driver' => 'local',
        'root' => storage_path('localizations'),
        'throw' => false,
    ],
];
