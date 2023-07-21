<?php

return [
    /**
     * Custom filesystems.disks.languages config
     */
    'languages' => [
        'driver' => 'local',
        'root' => lang_path(),
        'throw' => false,
    ],
];
