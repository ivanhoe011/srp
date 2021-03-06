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
require_once "lib/db/Catalog.php";
require_once "application/models/beans/Timetable.php";
require_once "application/models/exceptions/TimetableException.php";
require_once "application/models/collections/TimetableCollection.php";
require_once "application/models/factories/TimetableFactory.php";
require_once "application/models/catalogs/TimetableLogCatalog.php";

/**
 * Singleton TimetableCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class TimetableCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var TimetableCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return TimetableCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase TimetableCatalog
     * @return TimetableCatalog
     */
    protected function TimetableCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un Timetable a la base de datos
     * @param Timetable $timetable Objeto Timetable
     */
    public function create($timetable)
    {
        if(!($timetable instanceof Timetable))
            throw new TimetableException("passed parameter isn't a Timetable instance");
        try
        {
            $data = array(
                'id_employee' => $timetable->getIdEmployee(),
                'id_project' => $timetable->getIdProject(),
                'id_project_task' => $timetable->getIdProjectTask(),
                'id_approver_1' => $timetable->getIdApprover1(),
                'id_approver_2' => $timetable->getIdApprover2(),
                'id_current_approver' => $timetable->getIdCurrentApprover(),
                'description' => $timetable->getDescription(),
                'attendance_type' => $timetable->getAttendanceType(),
                'date' => $timetable->getDate(),
                'status' => $timetable->getStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(Timetable::TABLENAME, $data);
            $timetable->setIdTimetable($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new TimetableException("The Timetable can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idTimetable
     * @param boolean $throw
     * @return Timetable|null
     */
    public function getById($idTimetable, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(Timetable::ID_TIMETABLE, $idTimetable, Criteria::EQUAL);
            $newTimetable = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new TimetableException("Can't obtain the Timetable \n" . $e->getMessage());
        }
        if($throw && null == $newTimetable)
            throw new TimetableException("The Timetable at $idTimetable not exists ");
        return $newTimetable;
    }

    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return TimetableCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new TimetableCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(Timetable::ID_TIMETABLE, $ids, Criteria::IN);
            $timetableCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new TimetableException("TimetableCollection can't be populated\n" . $e->getMessage());
        }
        return $timetableCollection;
    }

    /**
     * Metodo para actualizar un Timetable
     * @param Timetable $timetable
     */
    public function update($timetable)
    {
        if(!($timetable instanceof Timetable))
            throw new TimetableException("passed parameter isn't a Timetable instance");
        try
        {
            $where[] = "id_timetable = '{$timetable->getIdTimetable()}'";
            $data = array(
                'id_employee' => $timetable->getIdEmployee(),
                'id_project' => $timetable->getIdProject(),
                'id_project_task' => $timetable->getIdProjectTask(),
                'id_approver_1' => $timetable->getIdApprover1(),
                'id_approver_2' => $timetable->getIdApprover2(),
                'id_current_approver' => $timetable->getIdCurrentApprover(),
                'description' => $timetable->getDescription(),
                'attendance_type' => $timetable->getAttendanceType(),
                'date' => $timetable->getDate(),
                'status' => $timetable->getStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(Timetable::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new TimetableException("The Timetable can't be updated \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para guardar un timetable
     * @param Timetable $timetable
     */
    public function save($timetable)
    {
        if(!($timetable instanceof Timetable))
            throw new TimetableException("passed parameter isn't a Timetable instance");
        if(null != $timetable->getIdTimetable())
            $this->update($timetable);
        else
            $this->create($timetable);
    }

    /**
     * Metodo para eliminar un timetable
     * @param Timetable $timetable
     */
    public function delete($timetable)
    {
        if(!($timetable instanceof Timetable))
            throw new TimetableException("passed parameter isn't a Timetable instance");
        $this->deleteById($timetable->getIdTimetable());
    }

    /**
     * Metodo para eliminar un Timetable a partir de su Id
     * @param int $idTimetable
     */
    public function deleteById($idTimetable)
    {
        try
        {
            $where = array($this->db->quoteInto('id_timetable = ?', $idTimetable));
            $this->db->delete(Timetable::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new TimetableException("The Timetable can't be deleted\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar varios Timetable a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(Timetable::ID_TIMETABLE, $ids, Criteria::IN);
            $this->db->delete(Timetable::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new TimetableException("Can't delete that\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        return $this->getIdsByCriteria(new Criteria());
    }

    /**
     * Metodo para obtener todos los id de Timetable por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de Timetable que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(Timetable::ID_TIMETABLE, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un Timetable dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos Timetable que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".Timetable::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new TimetableException("No se pudieron obtener los fields de objetos Timetable\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos Timetable
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return TimetableCollection $timetableCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try
        {
            $sql = "SELECT * FROM ".Timetable::TABLENAME."
                    WHERE " . $criteria->createSql();
            $timetableCollection = new TimetableCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $timetableCollection->append($this->getTimetableInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new TimetableException("Cant obtain TimetableCollection\n" . $e->getMessage());
        }
        return $timetableCollection;
    }

    /**
     * Metodo que cuenta Timetable
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_timetable')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try
        {
            $sql = "SELECT COUNT( $field ) FROM ".Timetable::TABLENAME."
                    WHERE " . $criteria->createSql();
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new TimetableException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }

    /**
     * M�todo que construye un objeto Timetable y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return Timetable
     */
    private function getTimetableInstance($result)
    {
        return TimetableFactory::createFromArray($result);
    }

    /**
     * Obtiene un TimetableCollection  dependiendo del idEmployee
     * @param int $idEmployee
     * @return TimetableCollection
     */
    public function getByIdEmployee($idEmployee)
    {
        $criteria = new Criteria();
        $criteria->add(Timetable::ID_EMPLOYEE, $idEmployee, Criteria::EQUAL);
        $timetableCollection = $this->getByCriteria($criteria);
        return $timetableCollection;
    }

    /**
     * Obtiene un TimetableCollection  dependiendo del idProject
     * @param int $idProject
     * @return TimetableCollection
     */
    public function getByIdProject($idProject)
    {
        $criteria = new Criteria();
        $criteria->add(Timetable::ID_PROJECT, $idProject, Criteria::EQUAL);
        $timetableCollection = $this->getByCriteria($criteria);
        return $timetableCollection;
    }

    /**
     * Obtiene un TimetableCollection  dependiendo del idProjectTask
     * @param int $idProjectTask
     * @return TimetableCollection
     */
    public function getByIdProjectTask($idProjectTask)
    {
        $criteria = new Criteria();
        $criteria->add(Timetable::ID_PROJECT_TASK, $idProjectTask, Criteria::EQUAL);
        $timetableCollection = $this->getByCriteria($criteria);
        return $timetableCollection;
    }

    /**
     * Obtiene un TimetableCollection  dependiendo del idApprover1
     * @param int $idApprover1
     * @return TimetableCollection
     */
    public function getByIdApprover1($idApprover1)
    {
        $criteria = new Criteria();
        $criteria->add(Timetable::ID_APPROVER_1, $idApprover1, Criteria::EQUAL);
        $timetableCollection = $this->getByCriteria($criteria);
        return $timetableCollection;
    }

    /**
     * Obtiene un TimetableCollection  dependiendo del idApprover2
     * @param int $idApprover2
     * @return TimetableCollection
     */
    public function getByIdApprover2($idApprover2)
    {
        $criteria = new Criteria();
        $criteria->add(Timetable::ID_APPROVER_2, $idApprover2, Criteria::EQUAL);
        $timetableCollection = $this->getByCriteria($criteria);
        return $timetableCollection;
    }

    /**
     * Obtiene un TimetableCollection  dependiendo del idCurrentApprover
     * @param int $idCurrentApprover
     * @return TimetableCollection
     */
    public function getByIdCurrentApprover($idCurrentApprover)
    {
        $criteria = new Criteria();
        $criteria->add(Timetable::ID_CURRENT_APPROVER, $idCurrentApprover, Criteria::EQUAL);
        $timetableCollection = $this->getByCriteria($criteria);
        return $timetableCollection;
    }

    /**
     * Metodo que regresa una coleccion de objetos Timetable con Status 'Active'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return TimetableCollection $timetableCollection
     */
    public function getActives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        // $criteria->add(Timetable::STATUS, Timetable::$Status['Active'], Criteria::EQUAL);
        $criteria->add(Timetable::STATUS, Timetable::$Status['approved'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }

    /**
     * Metodo que regresa una coleccion de objetos Timetable con Status 'Inactive'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return TimetableCollection $timetableCollection
     */
    public function getInactives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(Timetable::STATUS, Timetable::$Status['Inactive'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }

    /**
     * Activate a timetable
     * @param Timetable $timetable
     */
    public function activate($timetable)
    {
        if(!($timetable instanceof Timetable))
            throw new TimetableException("passed parameter isn't a Timetable instance");
        if(Timetable::$Status['Active'] != $timetable->getStatus())
        {
            $timetable->setStatus(Timetable::$Status['Active']);
            $this->save($timetable);
        }
    }

    /**
     * Deactivate a timetable
     * @param Timetable $timetable
     */
    public function deactivate($timetable)
    {
        if(!($timetable instanceof Timetable))
            throw new TimetableException("passed parameter isn't a Timetable instance");
        if(Timetable::$Status['Inactive'] != $timetable->getStatus())
        {
            $timetable->setStatus(Timetable::$Status['Inactive']);
            $this->save($timetable);
        }
    }
    
	public function getIdProjectByIdEmployee($idEmployee) {
        try {
            $sql = "SELECT DISTINCT id_project FROM " . Timetable::TABLENAME . "
                   WHERE  id_current_approver = " . $idEmployee;
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new ProjectException("Can't obtain relations by criteria\n" . $e->getMessage());
        }
        return $result;
    }
    
    public function getTimeTablesByDate($startDate,$endDate)
    {
    	try 
        {
            $sql = "SELECT id_timetable, id_employee, id_project, id_project_task, description, attendance_type, date, id_current_approver, status FROM ".Timetable::TABLENAME."
                    WHERE date BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59'";
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain timetables\n" . $e->getMessage());
        }
        return $result;
    }
    
	/*
	 * 
	 */
	public function getTimeTablesGeneralByDate($idEmployee, $startDate)
    {
    	try 
        {
            $sql = "SELECT id_timetable, id_employee, id_project, id_project_task, description, attendance_type, date, id_current_approver 
            		FROM ".Timetable::TABLENAME."
                    WHERE id_current_approver = ".$idEmployee."
                    AND date='$startDate' 
                    AND (status =".Timetable::$Status["released"]." OR status=".Timetable::$Status["process"].")";
            //die($sql);
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain timetables\n" . $e->getMessage());
        }
        return $result;
    }
    
    /*
     * 
     */
    public function getDateRejectByIdTimetable($idTimetable)
    {
    	try 
        {
            $sql = "SELECT b.timestamp
            		FROM pcs_srp_core_timetables_logs AS b,
            		pcs_srp_core_timetables_logs_statuses AS c
                    WHERE b.id_timetable = ".$idTimetable." 
                    AND b.id_timetable_log = c.id_timetable_log
                    AND c.status = 3";
            list($timestamp) = $this->db->fetchCol($sql);
            $result = $timestamp;
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain timetables\n" . $e->getMessage());
        }
        return $result;
    }

    /*
     * 
     */
    public function getDateApprovalByIdTimetable($idTimetable)
    {
    	try 
        {
            $sql = "SELECT b.timestamp
            		FROM pcs_srp_core_timetables_logs AS b,
            		pcs_srp_core_timetables_logs_statuses AS c
                    WHERE b.id_timetable = ".$idTimetable." 
                    AND b.id_timetable_log = c.id_timetable_log
                    AND c.status = 4";
            list($timestamp) = $this->db->fetchCol($sql);
            $result = $timestamp;
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain timetables\n" . $e->getMessage());
        }
        return $result;
    }
    
 	/*
     * 
     */
    public function getDateReleaseByIdTimetable($idTimetable)
    {
    	try 
        {
            $sql = "SELECT b.timestamp
            		FROM pcs_srp_core_timetables_logs AS b,
            		pcs_srp_core_timetables_logs_statuses AS c
                    WHERE b.id_timetable = ".$idTimetable." 
                    AND b.id_timetable_log = c.id_timetable_log
                    AND c.status = 2";
            list($timestamp) = $this->db->fetchCol($sql);
            $result = $timestamp;
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain timetables\n" . $e->getMessage());
        }
        return $result;
    }
    
	public function getDisctinctDateByIdProjects($idProjects, $idEmployee)
    {
        try 
        {
            $sql = "SELECT DISTINCT DATE_FORMAT( b.record_date, '%Y-%m-%d' ) as date, b.id_timetable, a.status 
            		FROM ".Timetable::TABLENAME." AS a, 
            		pcs_srp_core_timetables_hours AS b 
                    WHERE a.id_employee = ".$idEmployee." 
                    AND a.id_timetable = b.id_timetable
                    AND a.id_project IN (".$idProjects.") ORDER BY date";
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain dates\n" . $e->getMessage());
        }
        return $result;
    }    
    
    public function getTypeHome($idTimetable)
    {
    	try 
        {
            $sql = "SELECT c.type
            		FROM pcs_srp_core_timetables_logs AS b,
            		pcs_srp_core_timetables_logs_approvers AS c
                    WHERE b.id_timetable = ".$idTimetable." 
                    AND b.id_timetable_log = c.id_timetable_log";
            list($type) = $this->db->fetchCol($sql);
            $result = $type;
        } catch (Exception $e) {
            throw new TimetableException("Can't obtain types timetables logs approvers\n" . $e->getMessage());
        }
        return $result;
    }
    
    
    public function getTimetablesBetweenDate($starting,$ending){
    	$criteria=new Criteria();
    	$criteria->add(Timetable::DATE,array($starting,$ending),Criteria::BETWEEN);
    	$status[]=Timetable::$Status['released'];
    	$status[]=Timetable::$Status['rejected'];
    	$status[]=Timetable::$Status['approved'];
    	$status[]=Timetable::$Status['not_registered'];
    	$status[]=Timetable::$Status['process'];
		$criteria->add(Timetable::STATUS,$status,Criteria::IN);
		
    	return $this->getByCriteria($criteria);
    }
    
    public function getTimetablesBetweenHours($starting,$ending,$date=null){
    	$criteria=new Criteria();
    	$criteria->add(Timetable::DATE,date("Y-m-d"),Criteria::EQUAL);
    	$status[]=Timetable::$Status['released'];
    	$status[]=Timetable::$Status['rejected'];
    	$status[]=Timetable::$Status['approved'];
    	$status[]=Timetable::$Status['not_registered'];
    	$status[]=Timetable::$Status['process'];
		$criteria->add(Timetable::STATUS,$status,Criteria::IN);
		
    	if(is_null($date))
    		$date=date("Y-m-d");
    		
    	$criteria_hours=new Criteria();
    	$criteria_hours->add(TimetableLog::TIMESTAMP,array($date.' '.$starting,$date.' '.$ending),Criteria::BETWEEN);
    	
    	$criteria->add(Timetable::ID_TIMETABLE,TimetableLogCatalog::getInstance()->getCustomFieldByCriteria(TimetableLog::ID_TIMETABLE,$criteria_hours,true),Criteria::IN);
    	return $this->getByCriteria($criteria);
    }
} 
