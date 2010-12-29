<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   Application
 * @package    Application_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/controller/CrudController.php";
require_once "application/models/catalogs/EmployeeCatalog.php";
require_once "lib/utils/employee_load/EmployeeUtilities.php";
require_once "lib/managers/EmployeeManager.php";
define("EMP_DIR", "./data/load/employee/");

/**
 * EmployeeController (CRUD for the Employee Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class EmployeeController extends CrudController
{
    
    /**
     * alias for the list action
     */
    public function indexAction()
    {
        $this->_forward('list');
    }
    
    /**
     * List the objects Employee actives
     */
    public function listAction()
    {
        $this->view->employees = EmployeeCatalog::getInstance()->getActives();
        $this->setTitle('List the Employee');
    }
    
    /**
     * delete an Employee
     */
    public function deleteAction()
    {
        $employeeCatalog = EmployeeCatalog::getInstance();
        $idEmployee = $this->getRequest()->getParam('idEmployee');
        $employee = $employeeCatalog->getById($idEmployee);
        $employeeCatalog->deactivate($employee);
        $this->setFlash('ok','Successfully removed the Employee');
        $this->_redirect('employee/list');
    }
    
    /**
     * Form for edit an Employee
     */
    public function editAction()
    {
        $employeeCatalog = EmployeeCatalog::getInstance();
        $idEmployee = $this->getRequest()->getParam('idEmployee');
        $employee = $employeeCatalog->getById($idEmployee);
        $post = array(
            'id_employee' => $employee->getIdEmployee(),
            'id_user' => $employee->getIdUser(),
            'id_department' => $employee->getIdDepartment(),
            'type' => $employee->getType(),
            'beginning_date' => $employee->getBeginningDate(),
            'ending_date' => $employee->getEndingDate(),
            'schedule_type' => $employee->getScheduleType(),
        );
        $this->view->post = $post;
        $this->setTitle('Edit Employee');
    }
    
    /**
     * Create an Employee
     */
    public function createAction()
    {   
        $employeeCatalog = EmployeeCatalog::getInstance();
        $idUser = utf8_decode($this->getRequest()->getParam('id_user'));
        $idDepartment = utf8_decode($this->getRequest()->getParam('id_department'));
        $type = utf8_decode($this->getRequest()->getParam('type'));
        $beginningDate = utf8_decode($this->getRequest()->getParam('beginning_date'));
        $endingDate = utf8_decode($this->getRequest()->getParam('ending_date'));
        $scheduleType = utf8_decode($this->getRequest()->getParam('schedule_type'));
        $employee = EmployeeFactory::create($idUser, $idDepartment, $type, $beginningDate, $endingDate, $scheduleType);
        $employeeCatalog->create($employee);  
        $this->view->setTpl('_row');
        $this->view->setLayoutFile(false);
        $this->view->employee = $employee;
    }
    
    /**
     * Update an Employee
     */
    public function updateAction()
    {
        $employeeCatalog = EmployeeCatalog::getInstance();
        $idEmployee = $this->getRequest()->getParam('idEmployee');
        $employee = $employeeCatalog->getById($idEmployee);
        $employee->setIdUser($this->getRequest()->getParam('id_user'));
        $employee->setIdDepartment($this->getRequest()->getParam('id_department'));
        $employee->setType($this->getRequest()->getParam('type'));
        $employee->setBeginningDate($this->getRequest()->getParam('beginning_date'));
        $employee->setEndingDate($this->getRequest()->getParam('ending_date'));
        $employee->setScheduleType($this->getRequest()->getParam('schedule_type'));
        $employeeCatalog->update($employee);
        $this->setFlash('ok','Successfully edited the Employee');
        $this->_redirect('employee/list');
    }
    public function uploadAction() {
        try {
            $row = 0;
            $archives = glob(EMP_DIR . "*.csv");

            if (count($archives) > 1)
                $this->view->warning_files = "Se encontr� mas de un archivo csv";
            if (($handle = fopen($archives[0], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, "|")) !== FALSE) {
                    if ($row == 0)
                        $titles = $data;
                    else
                        foreach ($data as $k => $v)
                            $data_fields[$row][$titles[$k]] = $v;
                    $row++;
                }
                fclose($handle);
                EmployeeManager::getInstance()->check_employees($data_fields);
                $digested_file = EmployeeUtilities::getInstance()->validateRowFields($data_fields);
                //print_r($digested_file);
                foreach ($digested_file["reported_rows"] as $key => $reported_row) {
                    unset($reported_row["ERROR"]);
                    $csv_lines[$key] = implode("|", $reported_row);
                }
                $result = EmployeeManager::getInstance()->upload_create($digested_file["ok_rows"]);
                $this->view->reported_rows = $digested_file["reported_rows"];
                $this->view->reported_rows_count = count($digested_file["reported_rows"]);
                $this->view->ok_rows = $digested_file["ok_rows"];
                $this->view->ok_rows_count = count($digested_file["ok_rows"]);
                $this->view->inserted_rows = $result["inserted_rows"];
                $this->view->db_errors = $result["db_errors"];
                $this->view->db_errors_count = count($result["db_errors"]);
                $this->view->csv_lines = $csv_lines;
                $this->view->rows_count = $row - 1;
                //unlink($archives[0]);
            }
        } catch (Exception $e) {
            $this->view->warning_files = "No hay ningun archivo para carga de datos";
        }
    }
}