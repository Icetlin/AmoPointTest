<?php
// Проверяем  был ли отправлен POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Получаем информацию о загруженном файле из массива $_FILES
    $file = $_FILES['file'];

    // Проверяем  есть ли ошибки при загрузке файла
    if ($file['error'] != UPLOAD_ERR_OK) {
        // Если есть ошибка, выводим красный круг
        echo "<div class='error-circle'></div>";
        exit; // Завершаем выполнение скрипта
    }

    // Определяем путь для сохранения файла в папке "files"
    $uploadDir = __DIR__ . '/files/'; 
    $uploadFile = $uploadDir . basename($file['name']); // Полный путь

    // Перемещаем загруженный файл из временной директории 
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        // Если файл успешно загружен
        echo "<div class='success-circle'></div>";

        // Читаем содержимое загруженного файла
        $content = file_get_contents($uploadFile);

        // Разбиваем содержимое файла по символу новой строки (\n)
        $lines = explode("\n", $content);

        // Проходимся по каждой строке файла
        foreach ($lines as $line) {
            // Удаляем лишние пробелы в начале и конце строки
            $line = trim($line);

            // Используем регулярное выражение взято из гугла сам за 3 года не научился их составлять -  для подсчета цифр в строке
            preg_match_all('/\d/', $line, $matches); 

            // Подсчитываем количество найденных цифр
            $count = count($matches[0]);

            // Выводим строку и количество цифр в ней
            echo "$line = $count<br>";
        }
    } else {
        // Если файл не удалось переместить, выводим красный круг
        echo "<div class='error-circle'></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла</title>
    <link rel="stylesheet" href="style.css"> <!-- Подключаем CSS -->
</head>
<body>
<!-- Форма для загрузки файла -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file" accept=".txt"> <!-- Поле для выбора файла -->
    <button type="submit">Загрузить</button> <!-- Кнопка отправки формы -->
</form>
</body>
</html>