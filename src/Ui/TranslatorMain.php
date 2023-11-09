<?php

declare(strict_types=1);

namespace MatheusSan\Translator\Ui;

use MatheusSan\Translator\Ui\Design\TranslatorButtons;
use Tkui\Application;
use Tkui\Widgets\Consts\Orient;
use Tkui\Widgets\LabelFrame;
use Tkui\Widgets\PanedWindow;
use Tkui\Widgets\Text\Text;

class TranslatorMain extends DemoAppWindow
{
    const APP_NAME = 'Translator';

    use TranslatorButtons;

    private string $imageDir;
    protected Application $app;

    public function __construct() {
        parent::__construct('Translator');
    }

    public function draw(): void
    {
        $panedWindow = new PanedWindow($this, ['orient' => Orient::ORIENT_HORIZONTAL]);
        $messageFrame = $this->messageFrame();
        $buttonsFrame = $this->buttonsFrame();
        $resultFrame = $this->resultFrame();

        $this->pack([$panedWindow, $messageFrame, $buttonsFrame, $resultFrame], ['padY' => 10]);

        $windowManager = $this->getWindowManager();
        $windowManager->setSize(480, 380);
        $windowManager->setMinSize(480, 380);
    }


    private function messageFrame(): LabelFrame
    {
        $messageFrame = new LabelFrame($this, 'Texto para Tradução/Revisão');
        $messageText = new Text($messageFrame, ['height' => 3, 'width' => 54]);
        $messageFrame->pack($messageText);

        return $messageFrame;
    }

    private function resultFrame(): LabelFrame
    {
        $labelFrame = new LabelFrame($this, 'Resultado');
        $resultText = new Text($labelFrame, ['height' => 5, 'width' => 54]);
        $labelFrame->pack($resultText, [ 'pady' => 2 ]);

        return $labelFrame;
    }

}
