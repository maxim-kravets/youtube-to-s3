<?php

namespace YoutubeToS3\Service;

use Aws\S3\S3Client;

class S3StorageConfiguration
{
    private $S3Client;
    private $bucket;
    private $bucket_dir;

    /**
     * @throws S3InvalidCredential
     */
    public function __construct()
    {
        if (empty($_SERVER['AWS_S3_VERSION'])) {
            throw new S3InvalidCredential('AWS_S3_VERSION can\'t be empty. Fill it in .env');
        }

        if (empty($_SERVER['AWS_S3_REGION'])) {
            throw new S3InvalidCredential('AWS_S3_REGION can\'t be empty. Fill it in .env');
        }

        if (empty($_SERVER['AWS_S3_KEY'])) {
            throw new S3InvalidCredential('AWS_S3_KEY can\'t be empty. Fill it in .env');
        }

        if (empty($_SERVER['AWS_S3_SECRET'])) {
            throw new S3InvalidCredential('AWS_S3_SECRET can\'t be empty. Fill it in .env');
        }

        if (empty($_SERVER['AWS_S3_BUCKET'])) {
            throw new S3InvalidCredential('AWS_S3_BUCKET can\'t be empty. Fill it in .env');
        }

        if (empty($_SERVER['AWS_S3_BUCKET_DIR'])) {
            throw new S3InvalidCredential('AWS_S3_BUCKET_DIR can\'t be empty. Fill it in .env');
        }

        $this->S3Client = new S3Client([
            'version' => $_SERVER['AWS_S3_VERSION'],
            'region'  => $_SERVER['AWS_S3_REGION'],
            'credentials' => [
                'key' => $_SERVER['AWS_S3_KEY'],
                'secret' => $_SERVER['AWS_S3_SECRET']
            ]
        ]);

        $this->bucket = $_SERVER['AWS_S3_BUCKET'];
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

    public function getBucketDir(): string
    {
        return $this->bucket_dir;
    }
}
