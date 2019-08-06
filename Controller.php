<?php

/**
 * For zenclass.
 * User: ttt
 * Date: 05.08.2019
 * Time: 21:28
 */
abstract class Controller {
    /**
     * Проверка входных данных
     * @return void
     * @throws Exception
     */
    abstract function validate();

    /**
     * выполнение
     * @return mixed
     */
    abstract function run();

    /** @var string сообщение на выходе */
    public $message;
}