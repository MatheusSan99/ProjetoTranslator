<?php

declare(strict_types=1);

namespace MatheusSan\Translator\Ui;

use Tkui\Application;
use Tkui\Dialogs\DirectoryDialog;
use Tkui\Dialogs\OpenFileDialog;
use Tkui\Layouts\Pack;
use Tkui\Widgets\Buttons\Button;
use Tkui\Widgets\Consts\Anchor;
use Tkui\Widgets\Consts\Orient;
use Tkui\Widgets\Container;
use Tkui\Widgets\Frame;
use Tkui\Widgets\Label;
use Tkui\Widgets\LabelFrame;
use Tkui\Widgets\Menu\Menu;
use Tkui\Widgets\Menu\MenuItem;
use Tkui\Widgets\PanedWindow;
use Tkui\Widgets\Text\Text;
use function sodium_crypto_box_keypair;
use function sodium_crypto_box_publickey;
use function sodium_crypto_box_secretkey;
use function sodium_crypto_box_keypair_from_secretkey_and_publickey;
use function sodium_bin2hex;
use function sodium_hex2bin;
use function sodium_crypto_box_seal;
use function sodium_crypto_box_seal_open;

class MainWindow extends \Tkui\Windows\MainWindow
{
    private string $publicKeyPath = '';
    private string $secretKeyPath = '';
    private Text $messageText;
    private Text $resultText;

    public function __construct(Application $app, string $title)
    {
        parent::__construct($app, $title);
    }

    public function draw(): void
    {
        $this->defineApplicationMenu();

        $panedWindow = new PanedWindow($this, ['orient' => Orient::ORIENT_HORIZONTAL]);
        $messageFrame = $this->messageFrame();
        $buttonsFrame = $this->buttonsFrame();
        $resultFrame = $this->resultFrame();

        $this->pack([$panedWindow, $messageFrame, $buttonsFrame, $resultFrame], ['padY' => 10]);

        $windowManager = $this->getWindowManager();
        $windowManager->setSize(480, 380);
        $windowManager->setMinSize(480, 380);
    }

    private function defineApplicationMenu(): void
    {
        $menu = new Menu($this);

        $this->setMenu($menu);
    }


    private function messageFrame(): LabelFrame
    {
        $messageFrame = new LabelFrame($this, 'Texto para Tradução/Revisão');

        $this->messageText = new Text($messageFrame, ['height' => 3, 'width' => 54]);
        $messageFrame->pack($this->messageText);

        return $messageFrame;
    }

    private function resultFrame(): LabelFrame
    {
        $labelFrame = new LabelFrame($this, 'Resultado');
        $this->resultText = new Text($labelFrame, ['height' => 5, 'width' => 54]);
        $labelFrame->pack($this->resultText, [ 'pady' => 2 ]);

        return $labelFrame;
    }

    public function buttonsFrame(): Frame
    {
        $frame = new Frame($this);

        $encryptButton = new Button($frame, 'Traduzir');
        $encryptButton->onClick(function (): void {
            $plainText = $this->messageText->getContent();
            $cypher = sodium_crypto_box_seal($plainText, file_get_contents($this->publicKeyPath));

            $this->resultText->setContent(sodium_bin2hex($cypher));
        });

        $decryptButton = new Button($frame, 'Traducoes Fora do Padrao');
        $decryptButton->onClick(function (): void {
            $message = sodium_hex2bin(trim($this->messageText->getContent()));
            $keyPair = sodium_crypto_box_keypair_from_secretkey_and_publickey(
                file_get_contents($this->secretKeyPath),
                file_get_contents($this->publicKeyPath),
            );

            $plainText = sodium_crypto_box_seal_open($message, $keyPair);

            $this->resultText->setContent($plainText ?: 'Erro ao traduzir');
        });

        $frame->borderWidth = 1;
        $frame->pack($encryptButton, ['side' => Pack::SIDE_LEFT]);
        $frame->pack($decryptButton, ['side' => Pack::SIDE_RIGHT]);

        return $frame;
    }
}
