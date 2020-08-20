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
    public function transcode(Video $youtubeVideo): void
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($_SERVER['VIDEOS_DIR'].'/'.$youtubeVideo->getFilename());
        $video
            ->filters()
            ->resize(new Dimension(320, 240))
            ->synchronize();
        $video
            ->save(new X264(), 'export-x264.mp4')
            ->save(new WMV(), 'export-wmv.wmv')
            ->save(new WebM(), 'export-webm.webm');
    }
}