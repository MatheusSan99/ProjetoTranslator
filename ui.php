<?php

declare(strict_types=1);

use MatheusSan\Translator\Ui\TranslatorMain;
use Tkui\Environment;
use Tkui\TclTk\TkAppFactory;

require_once 'vendor/autoload.php';


$environment = new class implements Environment
{
    private static array $environmentData = [
        'WINDOWS_LIB_TCL' => '.\IronTcl\bin\tcl86t.dll',
        'WINDOWS_LIB_TK' => '.\IronTcl\bin\tk86t.dll',
        'DEBUG' => true,
    ];

    public function getValue(string $param, $default = null)
    {
        return self::$environmentData[$param] ?? $default;
    }
};
$factory = new TkAppFactory();
$app = $factory->createFromEnvironment($environment);

// TODO: Refactor this class because all the code lives there so far
$mainWindow = new TranslatorMain();
$mainWindow->draw();

$app->run();
