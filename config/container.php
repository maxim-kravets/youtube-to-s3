<?php

use YoutubeToS3\Service\Facade;
use YoutubeToS3\Service\FacadeInterface;
use YoutubeToS3\Service\S3Storage;
use YoutubeToS3\Service\S3StorageConfiguration;
use YoutubeToS3\Service\S3StorageConfigurationInterface;
use YoutubeToS3\Service\StorageInterface;
use YoutubeToS3\Service\Transcoder;
use YoutubeToS3\Service\TranscoderInterface;
use YoutubeToS3\Service\VideoPlatformInterface;
use YoutubeToS3\Service\YouTube;
use YoutubeToS3\Service\YouTubeConfiguration;
use YoutubeToS3\Service\YouTubeConfigurationInterface;
use function DI\create;

return [
    VideoPlatformInterface::class => create(YouTube::class),
    StorageInterface::class => create(S3Storage::class),
    TranscoderInterface::class => create(Transcoder::class),
    S3StorageConfigurationInterface::class => create(S3StorageConfiguration::class),
    YouTubeConfigurationInterface::class => create(YouTubeConfiguration::class),
    FacadeInterface::class => create(Facade::class)
];
