<?php


namespace YoutubeToS3\Service;


use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\X264;
use YoutubeDl\Entity\Video;

class Transcoder implements TranscoderInterface
{
    private $width = 320;
    private $height = 240;
    private $format_x264 = true;
    private $format_wmv = true;
    private $format_webm = true;

    public function transcode(Video $youtubeVideo): void
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($_SERVER['VIDEOS_DIR'].'/'.$youtubeVideo->getFilename());
        $video
            ->filters()
            ->resize(new Dimension($this->width, $this->height))
            ->synchronize();

        if ($this->format_x264) {
            $format = (new X264())->on('progress', $this->getProgressCallback());
            $video->save($format, 'export-x264.mp4');
        }

        if ($this->format_wmv) {
            $format = (new WMV())->on('progress', $this->getProgressCallback());
            $video->save($format, 'export-wmv.wmv');
        }

        if ($this->format_webm) {
            $format = (new WebM())->on('progress', $this->getProgressCallback());
            $video->save($format, 'export-webm.webm');
        }
    }

    private function getProgressCallback(): callable
    {
        return function ($video, $format, $percentage) {
            echo " \e[32m[".$format->getVideoCodec()." transcoding] ".$percentage."% transcoded\e[39m               \r";
        };
    }
}