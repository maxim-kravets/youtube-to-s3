<?php

namespace YoutubeToS3\Service;

use YoutubeDl\Entity\Video;
use YoutubeToS3\Kernel;

class S3Storage implements StorageInterface
{
    private $configuration;

    public function __construct(S3StorageConfigurationInterface $s3StorageConfiguration)
    {
        $this->configuration = $s3StorageConfiguration;
    }

    public function upload(Video $video): void
    {
        $dirname = str_replace(' ', '_', substr($video->getFilename(), 0, stripos($video->getFilename(), '.')));

        $files = glob(Kernel::getDownloadsDir().'*');

        foreach ($files as $file) {
            if(is_file($file)) {
                $filename = basename($file);
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $this->configuration->getS3Client()->putObject([
                    'Bucket' => $this->configuration->getBucket(),
                    'Key'    => $this->configuration->getBucketDir().'/'.$dirname.'/'.$filename,
                    'SourceFile' => $file,
                    '@http' => [
                        'progress' => $this->getProgressCallback($ext)
                    ]
                ]);
            }
        }
    }

    private function getProgressCallback(string $ext): callable
    {
        return function ($downloadTotalSize, $downloadSizeSoFar, $uploadTotalSize, $uploadSizeSoFar) use ($ext) {

            if ($uploadSizeSoFar !== 0) {
                $percentage = round((($uploadSizeSoFar * 100) / $uploadTotalSize), 1);
            } else {
                $percentage = 0;
            }

            echo " \e[32m[S3 $ext uploading] $percentage% uploaded\e[39m                                                 \r";
        };
    }
}
