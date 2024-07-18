<?php

return [
    /**
     * Custom filesystems.disks.languages config
     */
    'languages' => [
        'driver' => 'local',
        'root' => storage_path('localizations'),
        'throw' => false,
    ],
];
