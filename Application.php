/*  application entry point

    - Пояснение и логика приложения (это я больше для себя написал, чтобы не забыть):

    создается объект бара (тоесть в программе, фактически, их может быть несколько, с разной аудиторией)
    с названием $name и максимальным количеством посетителей $maxVisitors

    тик происходит каждые 5 секунд, чтобы симулировать течение времени (в реальности треки идут от 2 до 5 минут,
    но это же симуляция, смысл ждать

    затем трек меняется (ну в модели упрощено, что меняются просто жанры)

    затем тик вызывается у всех посетителей бара, и проверяется, является ли текущий жанр - их любимым

    если да, то они идут танцевать - Action::DANCING

    если же трек - не их любимого жанра, то они идут Action::DRINKING

    ---

    после 5 прослушиваний нелюбимых жанров
    Dispose() этого посетителя
    и удаление из пула посетителей, тобишь из бара

    И/ИЛИ

    добавление вместо него нового посетителя,
    таким образом будет постоянно поддерживаться +- лояльная/универсальная аудитория
*/

<?php

include 'Classes/Bar.php';

$bar = new Bar("bar1", 15);

while (true) {
    $bar->tick();
    sleep(1);

    // clearing the console (working only on Win/Linux terminals [dont working 4 me on PhpStorm debug console])
    echo "\e[H\e[J";
}