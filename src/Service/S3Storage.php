<?php

namespace YoutubeToS3\Service;

use YoutubeDl\Entity\Video;

class S3Storage implements StorageInterface
{
    private $configuration;

    public function __construct(S3StorageConfigurationInterface $s3StorageConfiguration)
    {
        $this->configuration = $s3StorageConfiguration;
    }

    public function upload(Video $video): void
    {
        $progressBar = function ($downloadTotalSize, $downloadSizeSoFar, $uploadTotalSize, $uploadSizeSoFar) {

            if ($uploadSizeSoFar !== 0) {
                $percentage = round((($uploadSizeSoFar * 100) / $uploadTotalSize), 1);
            } else {
                $percentage = 0;
            }

            echo "\e[32m [storage uploading] $percentage% uploaded\e[39m \r";
        };

        $this->configuration->getS3Client()->putObject([
            'Bucket' => $this->configuration->getBucket(),
            'Key'    => $this->configuration->getBucketDir().'/'.$video->getFilename(),
            'SourceFile' => $this->configuration->getVideosDir().'/'.$video->getFilename(),
            '@http' => [
                'progress' => $progressBar
            ]
        ]);
    }
}