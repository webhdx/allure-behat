<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Allure\Behat\Extension;

use Behat\Mink\Mink;
use Bex\Behat\ScreenshotExtension\Service\ScreenshotTaker as BaseScreenshotTaker;
use Bex\Behat\ScreenshotExtension\ServiceContainer\Config;
use Symfony\Component\Console\Output\OutputInterface;
use Yandex\Allure\Adapter\Allure;
use Yandex\Allure\Adapter\Event\AddAttachmentEvent;

class ScreenshotTaker extends BaseScreenshotTaker
{
    private $baseScreenshotTaker;

    public function __construct(BaseScreenshotTaker $baseScreenshotTaker)
    {
      $this->baseScreenshotTaker = $baseScreenshotTaker;
    }

  public function takeScreenshot(): void
    {
        $this->baseScreenshotTaker->takeScreenshot();
        Allure::lifecycle()->fire(new AddAttachmentEvent($this->baseScreenshotTaker->getImage(), 'Browser screenshot'));
    }
}
