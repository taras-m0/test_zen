<?php
/**
 * For zenclass.
 * User: ttt
 * Date: 06.08.2019
 * Time: 8:39
 */

namespace API;
use Exception;

class SessionSubscribe extends \Controller {
    /** @var int максимальное кол-во слушателей */
    protected $maxUserForSession = 100;

    protected $userId;

    function validate() {

        if(empty($_REQUEST['sessionId'])){
            throw new Exception('sessionId not found');
        }

        if(empty($_REQUEST['userEmail'])){
            throw new Exception('userEmail not found');
        }

        $sth = \DB::instance()->prepare('SELECT id FROM `Session` WHERE id = ?');
        $sth->execute([ $_REQUEST['sessionId']]);
        if(count($sth->fetchAll(\DB::FETCH_ASSOC)) < 1){
            throw new Exception('session access denied');
        }

        $sth = \DB::instance()->prepare('SELECT id FROM `Session_Users` WHERE session = ?');
        $sth->execute([ $_REQUEST['sessionId']]);
        if(count($sth->fetchAll(\DB::FETCH_ASSOC)) > $this->maxUserForSession){
            throw new Exception('Извините, все места заняты');
        }

        $sth = \DB::instance()->prepare('SELECT id FROM `Participant` WHERE Email = ?');
        $sth->execute([ $_REQUEST['userEmail']]);
        $user = $sth->fetchAll(\DB::FETCH_ASSOC);
        if(count($user) < 1){
            throw new Exception('user access denied');
        }
        $this->userId = $user[0]['id'];
    }

    function run() {
        $sth = \DB::instance()->prepare('INSERT `Session_Users` (session, user) VVALUES (?, ?)');
        $sth->execute([ $_REQUEST['sessionId'], $this->userId]);

        $this->message = 'Спасибо, вы успешно записаны!';
        return true;
    }


}