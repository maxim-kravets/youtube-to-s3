<?php


namespace YoutubeToS3\Service;


use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\X264;
use YoutubeDl\Entity\Video;
use YoutubeToS3\Kernel;

class Transcoder implements TranscoderInterface
{
    private $configuration;

    public function __construct()
    {
        $this->configuration = new TranscoderConfiguration();
    }

    public function transcode(Video $youtubeVideo): void
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open(Kernel::getDownloadsDir().$youtubeVideo->getFilename());
        $video
            ->filters()
            ->resize(new Dimension(
                $this->configuration->getWidth(),
                $this->configuration->getHeight()
            ))
            ->synchronize();

        if ($this->configuration->isFormatX264()) {
            $format = (new X264())->on('progress', $this->getProgressCallback());
            $video->save($format, Kernel::getDownloadsDir().'video.mp4');
        }

        if ($this->configuration->isFormatWmv()) {
            $format = (new WMV())->on('progress', $this->getProgressCallback());
            $video->save($format, Kernel::getDownloadsDir().'video.wmv');
        }

        if ($this->configuration->isFormatWebm()) {
            $format = (new WebM())->on('progress', $this->getProgressCallback());
            $video->save($format, Kernel::getDownloadsDir().'video.webm');
        }
    }

    private function getProgressCallback(): callable
    {
        return function ($video, $format, $percentage) {
            echo " \e[32m[".$format->getVideoCodec()." transcoding] ".$percentage."% transcoded\e[39m               \r";
        };
    }
}