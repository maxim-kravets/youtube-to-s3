<?php

use YoutubeToS3\Service\Facade;
use YoutubeToS3\Service\FacadeInterface;
use YoutubeToS3\Service\S3Storage;
use YoutubeToS3\Service\S3StorageConfiguration;
use YoutubeToS3\Service\S3StorageConfigurationInterface;
use YoutubeToS3\Service\StorageInterface;
use YoutubeToS3\Service\Transcoder;
use YoutubeToS3\Service\TranscoderConfiguration;
use YoutubeToS3\Service\TranscoderConfigurationInterface;
use YoutubeToS3\Service\TranscoderInterface;
use YoutubeToS3\Service\VideoPlatformInterface;
use YoutubeToS3\Service\YouTube;
use YoutubeToS3\Service\YouTubeConfiguration;
use YoutubeToS3\Service\YouTubeConfigurationInterface;
use function DI\get;

return [
    VideoPlatformInterface::class => get(YouTube::class),
    StorageInterface::class => get(S3Storage::class),
    TranscoderInterface::class => get(Transcoder::class),
    TranscoderConfigurationInterface::class => get(TranscoderConfiguration::class),
    S3StorageConfigurationInterface::class => get(S3StorageConfiguration::class),
    YouTubeConfigurationInterface::class => get(YouTubeConfiguration::class),
    FacadeInterface::class => get(Facade::class)
];
