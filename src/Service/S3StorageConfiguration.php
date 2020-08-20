<?php

namespace YoutubeToS3\Service;

use Aws\S3\S3Client;

class S3StorageConfiguration implements S3StorageConfigurationInterface
{
    private $S3Client;
    private $bucket;
    private $videos_dir;
    private $bucket_dir;

    public function __construct()
    {
        $this->S3Client = new S3Client([
            'version' => $_SERVER['AWS_S3_VERSION'],
            'region'  => $_SERVER['AWS_S3_REGION'],
            'credentials' => [
                'key' => $_SERVER['AWS_S3_KEY'],
                'secret' => $_SERVER['AWS_S3_SECRET']
            ]
        ]);

        $this->bucket = $_SERVER['AWS_S3_BUCKET'];
        $this->videos_dir = $_SERVER['VIDEOS_DIR'];
        $this->bucket_dir = $_SERVER['AWS_S3_BUCKET_DIR'];
    }

    public function getS3Client(): S3Client
    {
        return $this->S3Client;
    }

    public function getBucket(): string
    {
        return $this->bucket;
    }

    public function getVideosDir(): string
    {
        return $this->videos_dir;
    }

    public function getBucketDir(): string
    {
        return $this->bucket_dir;
    }
}
