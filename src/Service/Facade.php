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

    public function __construct(
        VideoPlatformInterface $videoPlatformService,
        TranscoderInterface $transcoderService,
        StorageInterface $storageService
    ) {
        $this->videoPlatformService = $videoPlatformService;
        $this->transcoderService = $transcoderService;
        $this->storageService = $storageService;
        $this->initConsole();
    }

    private function initConsole(): void
    {
        $input = new ArgvInput();
        $output = new ConsoleOutput();
        $this->console = new SymfonyStyle($input, $output);
    }

    public function processVideo(): void
    {
        $this->cleanupDownloads();

        $url = $this->console->ask('Enter video url to download');

        $video = $this->videoPlatformService->download($url);
        $this->transcoderService->transcode($video);
        $this->storageService->upload($video);

        $this->console->success('Video successfully uploaded');

        $this->cleanupDownloads();
    }

    private function cleanupDownloads(): void
    {
        $files = glob(dirname(__DIR__).'/../downloads/*');

        foreach ($files as $file) {
            if(is_file($file))
                unlink($file);
        }
    }

}

