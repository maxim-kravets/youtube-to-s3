<?php


namespace YoutubeToS3\Service;


class YouTube implements VideoPlatformInterface
{
    private $configuration;

    public function __construct()
    {
        $this->configuration = new YouTubeConfiguration();
    }

    public function download(string $url)
    {
        return $this->configuration->getDL()->download($url);
    }
}