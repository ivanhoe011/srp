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
require_once "application/models/beans/Department.php";

/**
 * Clase DepartmentFactory
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_factories
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class DepartmentFactory
{

   /**
    * Create a new Department instance
    * @param int $idDepartmentHead
    * @param string $departmentCode
    * @param string $departmentName
    * @param int $status
    * @return Department
    */
   public static function create($idDepartmentHead, $departmentCode, $departmentName, $status)
   {
      throw new Exception('Factory Deprecated');
      $newDepartment = new Department();
      $newDepartment
          ->setIdDepartmentHead($idDepartmentHead)
          ->setDepartmentCode($departmentCode)
          ->setDepartmentName($departmentName)
          ->setStatus($status)
      ;
      return $newDepartment;
   }
   
    /**
     * M�todo que construye un objeto Department y lo rellena con la informaci�n del rowset
     * @param array $fields El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return Department 
     */
    public static function createFromArray($fields)
    {
        $newDepartment = new Department();
        $newDepartment->setIdDepartment($fields['id_department']);
        $newDepartment->setIdDepartmentHead($fields['id_department_head']);
        $newDepartment->setDepartmentCode($fields['department_code']);
        $newDepartment->setDepartmentName($fields['department_name']);
        $newDepartment->setStatus($fields['status']);
        return $newDepartment;
    }
   
}