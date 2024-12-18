<?php

declare(strict_types=1);

use controller\TodoController;
use src\Route;

Route::get('/', fn() => (new TodoController())->read());

Route::post('/create', fn() => (new TodoController())->create());

Route::delete('/delete/{id}', fn(int $id) => (new TodoController())->delete($id));

Route::patch('/update/{id}', fn(int $id) => (new TodoController())->update($id));