<?php

namespace controller;

use PDO;
use src\ToDo;

class TodoController
{
    public function create(): void
    {
        if ($_POST['inputText'] === '')
        {
            $this->error("Iltimos maydonni to`ldiring!");
            exit();
        }

        $text = $_POST['inputText'];
        $bool = (new ToDo())->create($text);

        if (!$bool) {
            $this->error('Ma`lumot kiritishda xatolik yuz berdi!');
            exit();
        }

        redirect('/');
    }

    public function read(): void
    {
        $todos = (new ToDo())->read();
        view('welcome', ['todos' => $todos]);
    }

    public function update(int $id): void
    {
        if ($_POST['inputText'] === '')
        {
            $this->error("Iltimos maydonni to`ldiring!");
            exit();
        }

        $text = $_POST['inputText'];

        $bool = (new ToDo())->update($id, $text);

        if (!$bool) {
            $this->error('Ma`lumot yangilashda xatolik yuz berdi!');
            exit();
        }

        redirect('/');
    }

    public function delete(int $id): void
    {
        $bool = (new ToDo())->delete($id);

        if (!$bool) {
            $this->error('Ma`lumot o`chirishda xatolik yuz berdi!');
        }

        redirect('/');
    }

    public function error(string $message): void
    {
        $todos = (new ToDo())->read();
        view('welcome', ['error' => $message, 'todos' => $todos]);
    }
}