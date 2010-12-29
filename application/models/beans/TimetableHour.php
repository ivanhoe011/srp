<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */

/**
 * Clase TimetableHour
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class TimetableHour
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_srp_core_timetables_hours";

    /**
     * Constantes para los nombres de los campos
     */
    const ID_TIMETABLE_HOUR = "pcs_srp_core_timetables_hours.id_timetable_hour";
    const ID_TIMETABLE = "pcs_srp_core_timetables_hours.id_timetable";
    const ID_PROJECT_TASK = "pcs_srp_core_timetables_hours.id_project_task";
    const ID_PROJECT = "pcs_srp_core_timetables_hours.id_project";
    const RECORD_DATE = "pcs_srp_core_timetables_hours.record_date";
    const DESCRIPTION = "pcs_srp_core_timetables_hours.description";
    const HOURS = "pcs_srp_core_timetables_hours.hours";
    const DATE_CREATED = "pcs_srp_core_timetables_hours.date_created";
    const TIMESTAMP = "pcs_srp_core_timetables_hours.timestamp";
    const STATUS = "pcs_srp_core_timetables_hours.status";
    const TYPE = "pcs_srp_core_timetables_hours.type";
    

    /**
     * $idTimetableHour 
     * 
     * @var int $idTimetableHour
     */
    private $idTimetableHour;
    

    /**
     * $idTimetable 
     * 
     * @var int $idTimetable
     */
    private $idTimetable;
    

    /**
     * $idProjectTask 
     * 
     * @var int $idProjectTask
     */
    private $idProjectTask;
    

    /**
     * $idProject 
     * 
     * @var int $idProject
     */
    private $idProject;
    

    /**
     * $recordDate 
     * 
     * @var datetime $recordDate
     */
    private $recordDate;
    

    /**
     * $description 
     * 
     * @var string $description
     */
    private $description;
    

    /**
     * $hours 
     * 
     * @var int $hours
     */
    private $hours;
    

    /**
     * $dateCreated 
     * 
     * @var datetime $dateCreated
     */
    private $dateCreated;
    

    /**
     * $timestamp 
     * 
     * @var string $timestamp
     */
    private $timestamp;
    

    /**
     * $status 
     * 1=>draft,
2=>released,
3=>rejected,
4=>approved,
5=>not_registered
     * @var int $status
     */
    private $status;
    

    /**
     * $type 
     * 1=>specific,
2=>department

     * @var int $type
     */
    private $type;

    /**
     * Set the idTimetableHour value
     * 
     * @param int idTimetableHour
     * @return TimetableHour $timetableHour
     */
    public function setIdTimetableHour($idTimetableHour)
    {
        $this->idTimetableHour = $idTimetableHour;
        return $this;
    }

    /**
     * Return the idTimetableHour value
     * 
     * @return int
     */
    public function getIdTimetableHour()
    {
        return $this->idTimetableHour;
    }

    /**
     * Set the idTimetable value
     * 
     * @param int idTimetable
     * @return TimetableHour $timetableHour
     */
    public function setIdTimetable($idTimetable)
    {
        $this->idTimetable = $idTimetable;
        return $this;
    }

    /**
     * Return the idTimetable value
     * 
     * @return int
     */
    public function getIdTimetable()
    {
        return $this->idTimetable;
    }

    /**
     * Set the idProjectTask value
     * 
     * @param int idProjectTask
     * @return TimetableHour $timetableHour
     */
    public function setIdProjectTask($idProjectTask)
    {
        $this->idProjectTask = $idProjectTask;
        return $this;
    }

    /**
     * Return the idProjectTask value
     * 
     * @return int
     */
    public function getIdProjectTask()
    {
        return $this->idProjectTask;
    }

    /**
     * Set the idProject value
     * 
     * @param int idProject
     * @return TimetableHour $timetableHour
     */
    public function setIdProject($idProject)
    {
        $this->idProject = $idProject;
        return $this;
    }

    /**
     * Return the idProject value
     * 
     * @return int
     */
    public function getIdProject()
    {
        return $this->idProject;
    }

    /**
     * Set the recordDate value
     * 
     * @param datetime recordDate
     * @return TimetableHour $timetableHour
     */
    public function setRecordDate($recordDate)
    {
        $this->recordDate = $recordDate;
        return $this;
    }

    /**
     * Return the recordDate value
     * 
     * @return datetime
     */
    public function getRecordDate()
    {
        return $this->recordDate;
    }

    /**
     * Set the description value
     * 
     * @param string description
     * @return TimetableHour $timetableHour
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Return the description value
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the hours value
     * 
     * @param int hours
     * @return TimetableHour $timetableHour
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
        return $this;
    }

    /**
     * Return the hours value
     * 
     * @return int
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set the dateCreated value
     * 
     * @param datetime dateCreated
     * @return TimetableHour $timetableHour
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * Return the dateCreated value
     * 
     * @return datetime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set the timestamp value
     * 
     * @param string timestamp
     * @return TimetableHour $timetableHour
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
     * Set the status value
     * 1=>draft,
2=>released,
3=>rejected,
4=>approved,
5=>not_registered
     * @param int status
     * @return TimetableHour $timetableHour
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Return the status value
     * 1=>draft,
2=>released,
3=>rejected,
4=>approved,
5=>not_registered
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the type value
     * 1=>specific,
2=>department

     * @param int type
     * @return TimetableHour $timetableHour
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Return the type value
     * 1=>specific,
2=>department

     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Status
     * @var Array
     */
    public static $Status = array(
        "draft"=>1,
        "released"=>2,
        "rejected"=>3,
        "approved"=>4,
        "not_registered"=>5
    );

    /**
     * Status Labels
     * @var Array
     */
    public static $StatusLabel = array(
        1=>"draft",
        2=>"released",
        3=>"rejected",
        4=>"approved",
        5=>"not_registered"
    );
}