<?php
/**
 * For zenclass.
 * User: ttt
 * Date: 05.08.2019
 * Time: 23:21
 */

namespace API;
use Exception;

class Table extends \Controller {

    protected $tableNames = ['News', 'Session'];

    function validate() {
        if(empty($_REQUEST['table'])){
            throw new Exception('param table not found');
        }

        if(!in_array($_REQUEST['table'], $this->tableNames)){
            throw new Exception('table ' . $_REQUEST['table'] . ' access denied');
        }

        if(empty($_REQUEST['id'])){
            $_REQUEST['id'] = 0;
        }else{
            $_REQUEST['id'] = (int) $_REQUEST['id'];
        }
    }

    function run() {

        $query = 'SELECT * FROM `' . $_REQUEST['table'] . '`';
        $params = [ ];

        if($_REQUEST['id']){
            $query .= ' WHERE id = ?';
            $params[] = $_REQUEST['id'];
        }

        $sth = \DB::instance()->prepare($query);
        $sth->execute( $params );
        return $sth->fetchAll(\DB::FETCH_ASSOC);
    }

}