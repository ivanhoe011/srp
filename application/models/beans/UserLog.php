<?php
/**
 * Bender Modeler
 *
 * Our Simple Models
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @author     <zetta> <chentepixtol>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */

/**
 * Clase UserLog
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code) 
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.0 SVN: $Revision$
 */
class UserLog
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_common_user_logs";
    const ID_USER_LOG = "pcs_common_user_logs.id_user_log";
    const ID_USER = "pcs_common_user_logs.id_user";
    const EVENT_TYPE = "pcs_common_user_logs.event_type";
    const IP = "pcs_common_user_logs.ip";
    const ID_RESPONSIBLE = "pcs_common_user_logs.id_responsible";
    const TIMESTAMP = "pcs_common_user_logs.timestamp";
    const NOTE = "pcs_common_user_logs.note";

    const LOGIN = 1;
    const LOGOUT = 2;
    const FAILED_LOGIN = 3;
    const CREATE = 4;
    const EDIT = 5;
    const DEACTIVATE = 6;
    const REACTIVATE = 7;
    /**
     * $idUserLog 
     * 
     * @var int $idUserLog
     */
    private $idUserLog;
    /**
     * $idUser 
     * 
     * @var int $idUser
     */
    private $idUser;
    /**
     * $eventType 
     * 
     * @var int $eventType
     */
    private $eventType;
    /**
     * $ip 
     * 
     * @var string $ip
     */
    private $ip;
    /**
     * $idResponsible 
     * 
     * @var int $idResponsible
     */
    private $idResponsible;
    /**
     * $timestamp 
     * 
     * @var string $timestamp
     */
    private $timestamp;

    /**
     * $timestampZendDate
     * 
     * @var Zend_Date $timestampZendDate
     */
    private $timestampZendDate;
    /**
     * $note 
     * 
     * @var string $note
     */
    private $note;

    /**
     * Set the idUserLog value
     * 
     * @param int idUserLog
     * @return UserLog $userLog
     */
    public function setIdUserLog($idUserLog)
    {
        $this->idUserLog = $idUserLog;
        return $this;
    }

    /**
     * Return the idUserLog value
     * 
     * @return int
     */
    public function getIdUserLog()
    {
        return $this->idUserLog;
    }

    /**
     * Set the idUser value
     * 
     * @param int idUser
     * @return UserLog $userLog
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * Return the idUser value
     * 
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the eventType value
     * 
     * @param int eventType
     * @return UserLog $userLog
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
        return $this;
    }

    /**
     * Return the eventType value
     * 
     * @return int
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set the ip value
     * 
     * @param string ip
     * @return UserLog $userLog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * Return the ip value
     * 
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set the idResponsible value
     * 
     * @param int idResponsible
     * @return UserLog $userLog
     */
    public function setIdResponsible($idResponsible)
    {
        $this->idResponsible = $idResponsible;
        return $this;
    }

    /**
     * Return the idResponsible value
     * 
     * @return int
     */
    public function getIdResponsible()
    {
        return $this->idResponsible;
    }

    /**
     * Set the timestamp value
     * 
     * @param string timestamp
     * @return UserLog $userLog
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Return the timestamp value
     * 
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

   /**
     * Return the timestamp value as Zend_Date Object
     * Using Lazy Loading for Zend Dates
     * 
     * @return Zend_Date
     */
    public function getTimestampAsZendDate()
    {
        if(!isset($this->timestampZendDate))
           $this->timestampZendDate = new Zend_Date($this->timestamp,"YYYY-MM-dd HH:mm:ss");
        return $this->timestampZendDate;
    }

    /**
     * Set the note value
     * 
     * @param string note
     * @return UserLog $userLog
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Return the note value
     * 
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

}