<?php


namespace YoutubeToS3\Service;


class YouTube implements VideoPlatformInterface
{
    private $configuration;

    public function __construct(YouTubeConfigurationInterface $youTubeConfiguration)
    {
        $this->configuration = $youTubeConfiguration;
    }

    public function download(string $url)
    {
        return $this->configuration->getDL()->download($url);
    }
}