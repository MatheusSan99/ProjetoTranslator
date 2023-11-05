<?php

namespace MatheusSan\Translator\Ui\Design;

use Tkui\Layouts\Pack;
use Tkui\Widgets\Buttons\Button;
use Tkui\Widgets\Frame;

trait TranslatorButtons {

    public function buttonsFrame(): Frame
    {
        $frame = new Frame($this);

        $encryptButton = new Button($frame, 'Traduzir');

        $decryptButton = new Button($frame, 'Traducoes Fora do Padrao');

        $frame->borderWidth = 1;
        $frame->pack($encryptButton, ['side' => Pack::SIDE_LEFT]);
        $frame->pack($decryptButton, ['side' => Pack::SIDE_RIGHT]);

        return $frame;
    }
}