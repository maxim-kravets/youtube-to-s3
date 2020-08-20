<?php

namespace YoutubeToS3\Service;

use YoutubeDl\Entity\Video;

interface StorageInterface
{
    public function upload(Video $video): void;
}