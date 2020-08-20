<?php


namespace YoutubeToS3\Service;


use YoutubeDl\Entity\Video;

interface TranscoderInterface
{
    public function transcode(Video $youtubeVideo): void;
}