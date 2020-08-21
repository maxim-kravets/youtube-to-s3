<?php


namespace YoutubeToS3\Service;


interface TranscoderConfigurationInterface
{
    public function getWidth(): int;
    public function getHeight(): int;
    public function isFormatX264(): bool;
    public function isFormatWmv(): bool;
    public function isFormatWebm(): bool;
}