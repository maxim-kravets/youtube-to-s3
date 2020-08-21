<?php


namespace YoutubeToS3\Service;


class TranscoderConfiguration implements TranscoderConfigurationInterface
{
    private $width = 320;
    private $height = 240;
    private $x264 = false;
    private $wmv = false;
    private $webm = false;
    private $available_formats = ['x264', 'wmv', 'webm'];

    public function __construct()
    {
        if (!empty($_SERVER['TRANSCODER_VIDEO_DIMENSION_WIDTH'])) {
            $this->width = (int) $_SERVER['TRANSCODER_VIDEO_DIMENSION_WIDTH'];
        }

        if (!empty($_SERVER['TRANSCODER_VIDEO_DIMENSION_HEIGHT'])) {
            $this->height = (int) $_SERVER['TRANSCODER_VIDEO_DIMENSION_HEIGHT'];
        }

        if (!empty($_SERVER['TRANSCODER_VIDEO_FORMATS'])) {
            $formats = explode(',', $_SERVER['TRANSCODER_VIDEO_FORMATS']);

            foreach ($formats as $format) {
                $format = strtolower(trim($format));
                if (in_array($format, $this->available_formats)) {
                    $this->$format = true;
                }
            }
        }
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function isFormatX264(): bool
    {
        return $this->x264;
    }

    public function isFormatWmv(): bool
    {
        return $this->wmv;
    }

    public function isFormatWebm(): bool
    {
        return $this->webm;
    }
}