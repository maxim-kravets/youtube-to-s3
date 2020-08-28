<?php

use YoutubeToS3\Service\Facade;
use YoutubeToS3\Service\FacadeInterface;
use YoutubeToS3\Service\S3Storage;
use YoutubeToS3\Service\StorageInterface;
use YoutubeToS3\Service\Transcoder;
use YoutubeToS3\Service\TranscoderInterface;
use YoutubeToS3\Service\VideoPlatformInterface;
use YoutubeToS3\Service\YouTube;
use function DI\get;

return [
    VideoPlatformInterface::class => get(YouTube::class),
    StorageInterface::class => get(S3Storage::class),
    TranscoderInterface::class => get(Transcoder::class),
    FacadeInterface::class => get(Facade::class)
];
