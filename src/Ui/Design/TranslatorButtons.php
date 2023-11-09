<?php

namespace MatheusSan\Translator\Ui\Design;

use Tkui\Layouts\Pack;
use Tkui\Widgets\Buttons\Button;
use Tkui\Widgets\Frame;
use Tkui\Widgets\TtkWidget;


trait TranslatorButtons {

    public function buttonsFrame(): Frame
    {
        $frame = new Frame($this);

        $botaoTraducao = new Button($frame, 'Traduzir');
        $botaoTraducao->compound = TtkWidget::COMPOUND_RIGHT;
        $botaoTraducao->image = $this->loadImage('tradutor.png');

        $botaoTraducaoForaDoPadrao = new Button($frame, 'Traducoes Fora do Padrao');
        $botaoTraducaoForaDoPadrao->compound = TtkWidget::COMPOUND_RIGHT;
        $botaoTraducaoForaDoPadrao->image = $this->loadImage('traducoesForaDoPadrao.png');

        $frame->borderWidth = 1;
        $frame->pack($botaoTraducao, ['side' => Pack::SIDE_LEFT,
            'ipadx' => 4,
            'ipady' => 4]);
        $frame->pack($botaoTraducaoForaDoPadrao, ['side' => Pack::SIDE_RIGHT,
            'ipadx' => 4,
            'ipady' => 4,]);

        return $frame;
    }

}