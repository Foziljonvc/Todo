<?php

namespace src;

class Route
{
    public static function get(string $path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path) {
            $callback();
            exit();
        }
    }

    public static function post(string $path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path) {
            $callback();
            exit();
        }
    }

    public static function delete(string $path, $callback): void
    {
        if (isset($_REQUEST['_method'])) {
            if (strtolower($_REQUEST['_method']) !== 'delete') {
                return;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ((new self())->getResourceId()) {
                $path = str_replace('{id}', (string) (new self())->getResourceId(), $path);
                if ($path === parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
                    $callback((new self())->getResourceId());
                    exit();
                }
            }
            $callback();
            exit();
        }
    }

    public static function patch(string $path, $callback): void
    {
        if (isset($_REQUEST['_method'])) {
            if (strtolower($_REQUEST['_method']) !== 'patch') {
                return;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ((new self())->getResourceId()) {
                $path = str_replace('{id}', (string) (new self())->getResourceId(), $path);
                if ($path === parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
                    $callback((new self())->getResourceId());
                    exit();
                }
            }
            $callback();
            exit();
        }
    }

    public function getResourceId(): false|int
    {
        $uri        = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path       = explode('/', $uri);
        $resourceId = $path[count($path) - 1];

        return is_numeric($resourceId) ? (int) $resourceId : false;
    }
}