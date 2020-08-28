# Youtube to S3

This is library to download video from YouTube, transcode this video in different formats and upload to AWS S3 storage.

## Installation

For installation execute the following command:

```
$ composer require maxim-kravets/youtube-to-s3
``` 

Then create .env and fill configuration variables:

```dotenv
AWS_S3_VERSION=latest
AWS_S3_REGION=your_region
AWS_S3_KEY=YOUR_AWS_API_KEY
AWS_S3_SECRET=YOUR_AWS_API_SECRET_KEY
AWS_S3_BUCKET=your.bucket
AWS_S3_BUCKET_DIR=directory_to_upload

TRANSCODER_VIDEO_DIMENSION_WIDTH=320
TRANSCODER_VIDEO_DIMENSION_HEIGHT=240
TRANSCODER_VIDEO_FORMATS="x264, wmv, webm"
```  

## Usage

For using this library in your projects, you can just run:

```php
use YoutubeToS3\Kernel;
use YoutubeToS3\Service\Facade;

require dirname(__DIR__).'/vendor/autoload.php';

$kernel = new Kernel();
$facade = $kernel->getContainer()->get(Facade::class);
$facade->processVideo();
```

or pass YouTube url directly:

```php
$facade->processVideo($url);
```

You can also create service instances from the src/Service directory for more fine-tuning of the application.

License
-------

[![license](https://img.shields.io/github/license/maxim-kravets/youtube-to-s3)](LICENSE)

This project is released under the terms of the BSD 3-Clause [license](LICENSE).

Copyright (c) 2019, Maxim Kravets