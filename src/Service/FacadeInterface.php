<?php


namespace YoutubeToS3\Service;


interface FacadeInterface
{
    public function processVideo(?string $url = null): void;
}