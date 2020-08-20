<?php


namespace YoutubeToS3\Service;


interface VideoPlatformInterface
{
    public function download(string $url);
}