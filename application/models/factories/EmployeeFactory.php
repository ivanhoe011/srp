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
 * Dependences
 */
require_once "application/models/beans/Employee.php";

/**
 * Clase EmployeeFactory
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_factories
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class EmployeeFactory
{

   /**
    * Create a new Employee instance
    * @param int $idDepartment
    * @param int $type
    * @param string $beginningDate
    * @param string $endingDate
    * @param string $scheduleType
    * @param string $username
    * @param string $password
    * @param int $status
    * @param int $idAccessRole
    * @param int $idPerson
    * @param int $system
    * @return Employee
    */
   public static function create($idDepartment, $type, $beginningDate, $endingDate, $scheduleType, $username, $password, $status, $idAccessRole, $idPerson, $system)
   {
      throw new Exception('Factory Deprecated');
      $newEmployee = new Employee();
      $newEmployee
          ->setIdDepartment($idDepartment)
          ->setType($type)
          ->setBeginningDate($beginningDate)
          ->setEndingDate($endingDate)
          ->setScheduleType($scheduleType)
          ->setUsername($username)
          ->setPassword($password)
          ->setStatus($status)
          ->setIdAccessRole($idAccessRole)
          ->setIdPerson($idPerson)
          ->setSystem($system)
      ;
      return $newEmployee;
   }
   
    /**
     * Método que construye un objeto Employee y lo rellena con la información del rowset
     * @param array $fields El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return Employee 
     */
    public static function createFromArray($fields)
    {
        $newEmployee = new Employee();
        $newEmployee->setIdEmployee($fields['id_employee']);
        $newEmployee->setIdUser($fields['id_user']);
        $newEmployee->setIdDepartment($fields['id_department']);
        $newEmployee->setType($fields['type']);
        $newEmployee->setBeginningDate($fields['beginning_date']);
        $newEmployee->setEndingDate($fields['ending_date']);
        $newEmployee->setScheduleType($fields['schedule_type']);
        $newEmployee->setUsername($fields['username']);
        $newEmployee->setPassword($fields['password']);
        $newEmployee->setStatus($fields['status']);
        $newEmployee->setIdAccessRole($fields['id_access_role']);
        $newEmployee->setIdPerson($fields['id_person']);
        $newEmployee->setSystem($fields['system']);
        return $newEmployee;
    }
   
}
