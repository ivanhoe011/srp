<?php
/**
 * SRP
 *
 * Sistema de Registro de Planillas
 *
 * @category   Application
 * @package    Application_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <marlen>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/controller/CrudController.php";
require_once "application/models/catalogs/TimetableCatalog.php";
require_once "application/models/catalogs/TimetableHourCatalog.php";
require_once "application/models/catalogs/EmployeeCatalog.php";
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/catalogs/PersonCatalog.php";
require_once "application/models/catalogs/CalendarDayCatalog.php";
require_once "application/models/catalogs/SpecificProjectCatalog.php";
require_once "application/models/catalogs/DepartmentProjectCatalog.php";
require_once "application/models/catalogs/DepartmentCatalog.php";
require_once "application/models/catalogs/ProjectTaskCatalog.php";

/**
 * ExportController (CRUD for the Export Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.0 SVN: $Revision$
 */
class ExportController extends Zend_Controller_Action
{    
 	protected function noRender()
    {
    	$this->getHelper('viewRenderer')->setNoRender();
    }
    
    /**
     * Exporta los datos al archivo Baan
     */
    public function excelAction()
    {  	
    	require_once 'excel/ExcelExt.php';
    	
    	$date = $this->getRequest()->getParam('date');
    	if (!$date)
    	{
    		$startWeek = mktime();
			$endWeek = mktime();
			while(date("w",$startWeek)!=1){
				$startWeek -= 3600;
			}
			while(date("w",$endWeek)!=0){
				$endWeek += 3600;
			}
			$startDate = date("Y-m-d",$startWeek);
			$endDate = date("Y-m-d",$endWeek);
    	}
    	else
    	{
	    	$startDate = date('Y-m-d', strtotime('last Monday', strtotime($date)));
		    $endDate = date('Y-m-d', strtotime('next Sunday', strtotime($date)));
    	}
    	
    	$export = array();
    	$timetables = TimetableCatalog::getInstance()->getTimeTablesByDate($startDate,$endDate);
    	if (empty($timetables))
    	{
    		echo "No existen registros en la fecha ingresada";
    		die();
    	}
    	foreach ($timetables as $timetable)
    	{
    		$idProjects = TimetableHourCatalog::getInstance()->getIdProjectsByTimetable($timetable['id_timetable']); 
    		   		    		    	
    		foreach ($idProjects as $idProject)
    		{    			
    			/***Datos de Empleado***/
    			$employee = EmployeeCatalog::getInstance()->getById($timetable['id_employee']);
	    		$username = $employee->getUsername();
	    		$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());    	
	    		$nameEmployee = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
	    		$department = DepartmentCatalog::getInstance()->getById($employee->getIdDepartment());
	    		$departmentEmployee = $department->getDepartmentCode();
	    		
	    		/***Datos de Proyecto***/
	    		$specificProject = SpecificProjectCatalog::getInstance()->getByIdProjectObject($idProject['id_project']);
	        	if ($specificProject == null)
	        	{
	        		$departmentProject = DepartmentProjectCatalog::getInstance()->getByIdProjectObject($idProject['id_project']);
	        		$department = DepartmentCatalog::getInstance()->getById($departmentProject->getIdDepartment());
	        		$projectName = $department->getDepartmentName();
	        	}
	        	else
	        		$projectName = $specificProject->getProjectName();
	        	
	        	/******************************************************Datos de Planilla************************************************************************/
	    		/***Inicio y Fin de Semana***/
	        	$weekBeginning = date('Y-m-d H:i:s', strtotime('last Monday', strtotime($timetable['date'])));
	        	list($dateweekBeginning, $timeweekBeginning) = explode(" ",$weekBeginning);
	        	$weekEnd = date('Y-m-d H:i:s', strtotime('next Sunday', strtotime($timetable['date'])));
    			list($dateweekEnd, $timeweekEnd) = explode(" ",$weekEnd);
    			
	    		
	    		/***Fecha de creaci�n***/
    			list($dateCreated, $timeCreated) = explode(" ",$timetable['date']);
    			$dDateCreated = explode('-', $dateCreated);
	        	$yearDateCreated = $dDateCreated[0];
	        	$monthDateCreated = $dDateCreated[1];
	        	$monthDateCreated=(string)(int)$monthDateCreated;
	        	$dayDateCreated = $dDateCreated[2];
	        	$dayDateCreated =(string)(int)$dayDateCreated;
	        	$dayWeekDateCreated = date("w",mktime(0,0,0,$monthDateCreated,$dayDateCreated,$yearDateCreated));
	        	
    			/***Fecha de liberaci�n***/
    			$dateRelease = TimetableCatalog::getInstance()->getDateReleaseByIdTimetable($timetable['id_timetable']);
	    		list($dateRelease, $timeRelease) = explode(" ",$dateRelease);
    			
	    		$dRelease = explode('-', $dateRelease);
	        	$yearRelease = $dRelease[0];
	        	$monthRelease = $dRelease[1];
	        	$monthRelease=(string)(int)$monthRelease;
	        	$dayRelease = $dRelease[2];
	        	$dayRelease =(string)(int)$dayRelease;
	        	$timestampDateRelease = mktime(0,0,0,$monthRelease,$dayRelease,$yearRelease);
	        	
	    		/***Fecha de aprobaci�n***/
	    		$dateApproval = TimetableCatalog::getInstance()->getDateApprovalByIdTimetable($timetable['id_timetable']);
	    		list($dateApproval, $timeApproval) = explode(" ",$dateApproval);

	    		$dApproval = explode('-', $dateApproval);
	        	$yearApproval = $dApproval[0];
	        	$monthApproval = $dApproval[1];
	        	$monthApproval=(string)(int)$monthApproval;
	        	$dayApproval = $dApproval[2];
	        	$dayApproval =(string)(int)$dayApproval;
	        	$timestampDateApproval = mktime(0,0,0,$monthApproval,$dayApproval,$yearApproval);
	    		
	    		/***Sumatoria de Horas***/
    			$sumHour = TimetableHourCatalog::getInstance()->getSumHoursByIdProject($idProject['id_project'],$timetable['id_timetable']);    			
    			
    			/***Fecha en que se debi� liberar***/
    			if($dayWeekDateCreated != '5')
    				$mustDateRelease = date('Y-m-d H:i:s', strtotime('next Friday', strtotime($timetable['date'])));
    			else
    				$mustDateRelease = $timetable['date'];
    				
    			list($dateMustDateRelease, $timeMustDateRelease) = explode(" ",$mustDateRelease);
    			
    			$dMustRelease = explode('-', $dateMustDateRelease);
	        	$yearMustRelease = $dMustRelease[0];
	        	$monthMustRelease = $dMustRelease[1];
	        	$monthMustRelease=(string)(int)$monthMustRelease;
	        	$dayMustRelease = $dMustRelease[2];
	        	$dayMustRelease =(string)(int)$dayMustRelease;
	        	$timestampMustDateRelease = mktime(0,0,0,$monthMustRelease,$dayMustRelease,$yearMustRelease);	        		        		       
	        	
	        	/***D�as trancurridos para Liberaci�n***/
	        	$daysRelease = ($timestampDateRelease - $timestampMustDateRelease)/(60 * 60 * 24);
	        	
	        	/***D�as transcurridos para Aprobaci�n***/
    			$daysApproval = ($timestampDateApproval - $timestampDateRelease)/(60 * 60 * 24);				
    			/*************************************************************************************************************************************************/
    			
    			/***Datos de Aprobadores***/
    			$approveLevel1 =ProjectCatalog::getInstance()->getApproverLevel1($idProject['id_project']);
    			$approveLevel2 =ProjectCatalog::getInstance()->getApproverLevel2($idProject['id_project']);
    			$approveLevel12 =ProjectCatalog::getInstance()->getApproverLevel12($idProject['id_project']);
    			$approveLevel22 =ProjectCatalog::getInstance()->getApproverLevel22($idProject['id_project']);
    			if($approveLevel1 != null)
    			{
	    			$approver1 = EmployeeCatalog::getInstance()->getById($approveLevel1);
	    			$usernameApprover1 = $approver1->getUsername();
	    			$personApprover1 = PersonCatalog::getInstance()->getById($approver1->getIdPerson());
	    			$nameApprover1 = $personApprover1->getName()." ".$personApprover1->getMiddleName()." ".$personApprover1->getLastName();	    			
    			}
    			if($approveLevel2 != null)
    			{
	    			$approver2 = EmployeeCatalog::getInstance()->getById($approveLevel2);
	    			$usernameApprover2 = $approver2->getUsername();
	    			$personApprover2 = PersonCatalog::getInstance()->getById($approver2->getIdPerson());
	    			$nameApprover2 = $personApprover2->getName()." ".$personApprover2->getMiddleName()." ".$personApprover2->getLastName();
    			}
    			
    			if (($approveLevel1 == $timetable['	id_current_approver']) || ($approveLevel12 == $timetable['	id_current_approver']))
    			{
    				$approved1 = "Aprob�";
    				$approved2 = " ";
    			}
    			else
    			{
    				$approved1 = " ";
    				$approved2 = "Aprob�";    				
    			}
    			
    			$export[] = array(
    				'Nro. Empleado' => $username,
    				'Nombre del Empleado' => $nameEmployee,
    				'Departamento' => $departmentEmployee,
    				'Inicio de Semana' => $dateweekBeginning,
    				'Fin de Semana' => $dateweekEnd,
    				'Proyecto' => $projectName,
    				'Horas' => $sumHour,
    				'Fecha de Creaci�n' => $dateCreated,
    				'Hora de Creaci�n' => $timeCreated,
    				'Creado por' => $username,
    				'Fecha Liberaci�n' => $dateRelease,
    				'Hora Liberaci�n' => $timeRelease,
    				'Status Planilla' => "Aprobado",
    				'Nro. de D�as en el Estatus' => "0",
    				'Nro. de D�as para Liberar' => $daysRelease,
    				'Nro. de D�as para Aprobar' => $daysApproval,
    				'Nro. de D�as en Proceso' => "0",
    				'Niv.1-Aprobador' => $usernameApprover1,
    				'Niv.1-Status' => $approved1,
    				'Niv.1-Fecha' => $dateApproval,
    				'Niv.1-Hora' => $timeApproval,
    				'Niv.2-Aprobador' => $usernameApprover2,
    				'Niv.2-Status' => $approved2,
    				'Niv.2-Fecha' => $dateApproval,
    				'Niv.2-Hora' => $timeApproval
    			);
    		}
    	}
    	$dateExport = str_replace(":","",str_replace("-","",str_replace(" ","",date("Y-m-d H:i"))));
       	$excel=ExcelExt::createExcel("ArchivoBaan".$dateExport.".xls", $export);
       	$this->noRender();	
    }
    
    public function generateAction()
    {
	$this->view;
    }
    public function missingAction()
    {
	require_once 'excel/ExcelExt.php';
    	
	$date = $this->getRequest()->getParam('date');
	$idEmp = $this->getRequest()->getParam('idEmp');
	$idDepartment = $this->getRequest()->getParam('idDept');
	$export = array();
	
    	if (!$date)
    	{
    		$startWeek = mktime();
		$endWeek = mktime();
		while(date("w",$startWeek)!=1)
		{
			$startWeek -= 3600;
		}
		while(date("w",$endWeek)!=0)
		{
			$endWeek += 3600;
		}
		$startDate = date("Y-m-d",$startWeek);
		$endDate = date("Y-m-d",$endWeek);
    	}
    	else
    	{
	    	$startDate = date('Y-m-d', strtotime('last Monday', strtotime($date)));
		$endDate = date('Y-m-d', strtotime('next Sunday', strtotime($date)));
    	}
	$timetables = TimetableCatalog::getInstance()->getTimeTablesByDate($startDate, $endDate);
	
	if($idEmp)
	{
		$timetablesByEmp = TimeTableCatalog::getInstance()->getByIdEmployee($idEmp)->toarray();
		$timetablesByEmp = array_intersect($timetables, $timetablesByEmp);
		if(empty($timetablesByEmp))
		{
			$employee = EmployeeCatalog::getInstance()->getById($idEmp);
			$username = $employee->getUsername();	
			$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());
			$nameEmployee = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
			$department = DepartmentCatalog::getInstance()->getById($employee->getIdDepartment());
			$departmentEmployee = $department->getDepartmentCode();
			$export[] = array(
				'Nro. Empleado' => $username,
				'Nombre del Empleado' => $nameEmployee,
				'Departamento' => $departmentEmployee
			);
		}
		else
		{
			print("Employee has submitted task for that period");
			die();
		}
	}
	else
	{
		$idEmployeesByDept = $idDepartment ?
			EmployeeCatalog::getInstance()->getIdsByDepartment($idDepartment) :
			EmployeeCatalog::getInstance()->retrieveAllIds();
		if (!empty($timetables))
			foreach($timetables as $timetable)
				$submitedEmployees[] = $timetable['id_employee'];
		else
			$submitedEmployees = EmployeeCatalog::getInstance()->retrieveAllIds();
			
		$idEmployees = array_intersect($idEmployeesByDept, $submitedEmployees);
		
		foreach ($idEmployees as $idEmployee)
		{
			//Employee information
			$employee = EmployeeCatalog::getInstance()->getById($idEmployee);
			$username = $employee->getUsername();	
			$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());
			$nameEmployee = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
			$department = DepartmentCatalog::getInstance()->getById($employee->getIdDepartment());
			$departmentEmployee = $department->getDepartmentCode();
			$export[] = array(
				'Nro. Empleado' => $username,
				'Nombre del Empleado' => $nameEmployee,
				'Departamento' => $departmentEmployee
			);
		}	
	}
    	$dateExport = str_replace(":","",str_replace("-","",str_replace(" ","",date("Y-m-d H:i"))));
       	$excel=ExcelExt::createExcel("ArchivoBaan".$dateExport.".xls", $export);
       	$this->noRender();
    }
}