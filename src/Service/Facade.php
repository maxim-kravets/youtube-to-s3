<?php


namespace YoutubeToS3\Service;


use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

class Facade implements FacadeInterface
{
    private $videoPlatformService;
    private $transcoderService;
    private $storageService;
    private $console;

    public function __construct(StorageInterface $storageService)
    {
        $this->initVideoPlatformService();
        $this->initTranscoderService();
        $this->storageService = $storageService;
        $this->initConsole();
    }

    private function initVideoPlatformService()
    {
        $this->videoPlatformService = new YouTube();
    }

    private function initTranscoderService()
    {
        $this->transcoderService = new Transcoder();
    }

    private function initConsole()
    {
        $input = new ArgvInput();
        $output = new ConsoleOutput();
        $this->console = new SymfonyStyle($input, $output);
    }

    public function processVideo(): void
    {
        $url = $this->console->ask('Enter video url to download');

        $video = $this->videoPlatformService->download($url);
        $this->transcoderService->transcode($video);
        $this->storageService->upload($video);

        $this->console->success('Video successfully uploaded');
    }

}

