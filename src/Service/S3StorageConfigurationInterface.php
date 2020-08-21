<?php


namespace YoutubeToS3\Service;


use Aws\S3\S3Client;

interface S3StorageConfigurationInterface
{
    public function getS3Client(): S3Client;
    public function getBucket(): string;
    public function getBucketDir(): string;
}
