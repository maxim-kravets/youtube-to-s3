<?php


namespace YoutubeToS3\Service;


use YoutubeDl\YoutubeDl;

class YouTubeConfiguration implements YouTubeConfigurationInterface
{
    private $dl;

    public function __construct()
    {
        $this->dl = new YoutubeDl([
            'continue' => true,
            'format' => 'bestvideo'
        ]);

        $this->dl->setDownloadPath($_SERVER['VIDEOS_DIR']);
        $this->dl->onProgress($this->getProgressCallback());
    }

    public function getDL(): YoutubeDl
    {
        return $this->dl;
    }

    private function getProgressCallback(): callable
    {
        return function ($progress) {
            echo " \e[32m[YouTube downloading] ".$progress['percentage']." downloaded\e[39m                                 \r";
        };
    }
}