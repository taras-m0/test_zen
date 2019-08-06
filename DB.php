<?php

/**
 * For zenclass.
 * User: ttt
 * Date: 05.08.2019
 * Time: 21:35
 */
class DB extends PDO {

    protected $login = 'root';
    protected $passw = '';
    protected $dsn = 'mysql:dbname=test_task;host=127.0.0.1';

    /** @var self */
    public static $inst;

    /**
     * @return self
     */
    public static function instance(){
        if(!self::$inst){
            self::$inst = new self();
        }

        return self::$inst;
    }

    public function __construct( ) {
        parent::__construct( $this->dsn, $this->login, $this->passw );
        $this->setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);
    }
}