<?php


namespace YoutubeToS3\Service;


use YoutubeDl\YoutubeDl;

interface YouTubeConfigurationInterface
{
    public function getDL(): YoutubeDl;
}