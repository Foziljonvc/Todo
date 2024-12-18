<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <style>
        .todo-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #e9ecef;
        }

        .number {
            min-width: 30px;
            font-weight: bold;
            color: #495057;
        }

        .todo-text {
            flex-grow: 1;
            margin: 0 15px;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        .update-btn {
            background-color: #0d6efd;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .update-btn:hover {
            background-color: #0b5ed7;
        }

        .delete-btn:hover {
            background-color: #bb2d3b;
        }
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 12px 20px;
            border-radius: 4px;
            border-left: 4px solid #ef5350;
            margin: 10px 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            animation: slideIn 0.3s ease-in-out;
        }

        .error-icon {
            margin-right: 10px;
            font-weight: bold;
            font-size: 16px;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .input-group {
            margin-bottom: 15px;
        }
        input[type="text"] {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #itemList {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Ma'lumot kiritish</h1>

    <?php
    /**
     * @var $error
     * @var $todos
     */
    ?>

    <?php if(isset($error)):?>
        <div class="error-message">
            <span class="error-icon">⚠️</span>
            <?= $error ?>
        </div>
    <?php endif;?>

    <div class="input-group">
        <form action="<?= isset($_GET['edit_id']) ? '/update/'.$_GET['edit_id'] : '/create' ?>" method="post">
            <?php if(isset($_GET['edit_id'])): ?>
                <input type="hidden" name="_method" value="PATCH">
            <?php endif; ?>

            <input type="text"
                   name="inputText"
                   value="<?= $_GET['edit_text'] ?? '' ?>"
                   placeholder="Ma'lumot kiriting">

            <button type="submit" class="<?= isset($_GET['edit_id']) ? 'update-btn' : 'add-btn' ?>">
                <?= isset($_GET['edit_id']) ? "O'zgartirish" : "Qo'shish" ?>
            </button>
        </form>
    </div>

    <div>
        <?php foreach ($todos as $key => $todo):?>
            <div class="todo-item">
                <span class="number"><?= $key + 1 ?>.</span>
                <span class="todo-text"><?= $todo->text ?></span>
                <div class="actions">
                    <a href="/?edit_id=<?= $todo->id ?>&edit_text=<?= $todo->text ?>"
                       class="btn update-btn">Yangilash</a>

                    <form action="/delete/<?= $todo->id ?>" method="POST" style="display: inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn delete-btn">O'chirish</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>