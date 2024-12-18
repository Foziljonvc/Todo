<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

function dd(mixed $argv): void
{
    var_dump($argv);
    die();
}

function view(string $url, array|null $argv = null): void
{
    if (is_array($argv)) {
        extract($argv);
    }

    require __DIR__ . "/resource/view/$url.php";
}

function redirect(string $url): void
{
    header("Location: $url");
    exit();
}