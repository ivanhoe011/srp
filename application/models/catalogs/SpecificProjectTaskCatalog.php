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
require_once "application/models/catalogs/ProjectTaskCatalog.php";
require_once "application/models/beans/SpecificProjectTask.php";
require_once "application/models/exceptions/SpecificProjectTaskException.php";
require_once "application/models/collections/SpecificProjectTaskCollection.php";
require_once "application/models/factories/SpecificProjectTaskFactory.php";

/**
 * Singleton SpecificProjectTaskCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class SpecificProjectTaskCatalog extends ProjectTaskCatalog
{

    /**
     * Singleton Instance
     * @var SpecificProjectTaskCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return SpecificProjectTaskCatalog
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
     * Constructor de la clase SpecificProjectTaskCatalog
     * @return SpecificProjectTaskCatalog
     */
    protected function SpecificProjectTaskCatalog()
    {
        parent::ProjectTaskCatalog();
    }

    /**
     * Metodo para agregar un SpecificProjectTask a la base de datos
     * @param SpecificProjectTask $specificProjectTask Objeto SpecificProjectTask
     */
    public function create($specificProjectTask)
    {
        if(!($specificProjectTask instanceof SpecificProjectTask))
            throw new SpecificProjectTaskException("passed parameter isn't a SpecificProjectTask instance");
        try
        {
            if(!$specificProjectTask->getIdProjectTask())
              parent::create($specificProjectTask);
            $data = array(
                'id_project_task' => $specificProjectTask->getIdProjectTask(),
                'work_authorization_status' => $specificProjectTask->getWorkAuthorizationStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(SpecificProjectTask::TABLENAME, $data);
            $specificProjectTask->setIdSpecificProjectTask($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new SpecificProjectTaskException("The SpecificProjectTask can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idSpecificProjectTask
     * @param boolean $throw
     * @return SpecificProjectTask|null
     */
    public function getById($idSpecificProjectTask, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProjectTask::ID_SPECIFIC_PROJECT_TASK, $idSpecificProjectTask, Criteria::EQUAL);
            $newSpecificProjectTask = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new SpecificProjectTaskException("Can't obtain the SpecificProjectTask \n" . $e->getMessage());
        }
        if($throw && null == $newSpecificProjectTask)
            throw new SpecificProjectTaskException("The SpecificProjectTask at $idSpecificProjectTask not exists ");
        return $newSpecificProjectTask;
    }
    
    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return SpecificProjectTaskCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new SpecificProjectTaskCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProjectTask::ID_SPECIFIC_PROJECT_TASK, $ids, Criteria::IN);
            $specificProjectTaskCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new SpecificProjectTaskException("SpecificProjectTaskCollection can't be populated\n" . $e->getMessage());
        }
        return $specificProjectTaskCollection;
    }

    /**
     * Metodo para actualizar un SpecificProjectTask
     * @param SpecificProjectTask $specificProjectTask 
     */
    public function update($specificProjectTask)
    {
        if(!($specificProjectTask instanceof SpecificProjectTask))
            throw new SpecificProjectTaskException("passed parameter isn't a SpecificProjectTask instance");
        try
        {
            $where[] = "id_specific_project_task = '{$specificProjectTask->getIdSpecificProjectTask()}'";
            $data = array(
                'id_project_task' => $specificProjectTask->getIdProjectTask(),
                'work_authorization_status' => $specificProjectTask->getWorkAuthorizationStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(SpecificProjectTask::TABLENAME, $data, $where);
            parent::update($specificProjectTask);
        }
        catch(Exception $e)
        {
            throw new SpecificProjectTaskException("The SpecificProjectTask can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un specificProjectTask
     * @param SpecificProjectTask $specificProjectTask
     */	
    public function save($specificProjectTask)
    {
        if(!($specificProjectTask instanceof SpecificProjectTask))
            throw new SpecificProjectTaskException("passed parameter isn't a SpecificProjectTask instance");
        if(null != $specificProjectTask->getIdSpecificProjectTask())
            $this->update($specificProjectTask);
        else
            $this->create($specificProjectTask);
    }

    /**
     * Metodo para eliminar un specificProjectTask
     * @param SpecificProjectTask $specificProjectTask
     */
    public function delete($specificProjectTask)
    {
        if(!($specificProjectTask instanceof SpecificProjectTask))
            throw new SpecificProjectTaskException("passed parameter isn't a SpecificProjectTask instance");
        $this->deleteById($specificProjectTask->getIdSpecificProjectTask());
        parent::delete($specificProjectTask);
    }

    /**
     * Metodo para eliminar un SpecificProjectTask a partir de su Id
     * @param int $idSpecificProjectTask
     */
    public function deleteById($idSpecificProjectTask)
    {
        try
        {
            $where = array($this->db->quoteInto('id_specific_project_task = ?', $idSpecificProjectTask));
            $this->db->delete(SpecificProjectTask::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new SpecificProjectTaskException("The SpecificProjectTask can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios SpecificProjectTask a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProjectTask::ID_SPECIFIC_PROJECT_TASK, $ids, Criteria::IN);
            $this->db->delete(SpecificProjectTask::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new SpecificProjectTaskException("Can't delete that\n" . $e->getMessage());
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
     * Metodo para obtener todos los id de SpecificProjectTask por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de SpecificProjectTask que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(SpecificProjectTask::ID_SPECIFIC_PROJECT_TASK, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un SpecificProjectTask dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos SpecificProjectTask que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".SpecificProjectTask::TABLENAME."
                      INNER JOIN ".ProjectTask::TABLENAME." USING ( id_project_task )
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new SpecificProjectTaskException("No se pudieron obtener los fields de objetos SpecificProjectTask\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos SpecificProjectTask 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return SpecificProjectTaskCollection $specificProjectTaskCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".SpecificProjectTask::TABLENAME."
                      INNER JOIN ".ProjectTask::TABLENAME." USING ( id_project_task )
                    WHERE " . $criteria->createSql();
            $specificProjectTaskCollection = new SpecificProjectTaskCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $specificProjectTaskCollection->append($this->getSpecificProjectTaskInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new SpecificProjectTaskException("Cant obtain SpecificProjectTaskCollection\n" . $e->getMessage());
        }
        return $specificProjectTaskCollection;
    }
    
    /**
     * Metodo que cuenta SpecificProjectTask 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_specific_project_task')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".SpecificProjectTask::TABLENAME."
                      INNER JOIN ".ProjectTask::TABLENAME." USING ( id_project_task )
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new SpecificProjectTaskException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * M�todo que construye un objeto SpecificProjectTask y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return SpecificProjectTask 
     */
    private function getSpecificProjectTaskInstance($result)
    {
        return SpecificProjectTaskFactory::createFromArray($result);
    }
  
    /**
     * Obtiene un SpecificProjectTaskCollection  dependiendo del idProjectTask
     * @param int $idProjectTask  
     * @return SpecificProjectTaskCollection 
     */
    public function getByIdProjectTask($idProjectTask)
    {
        $criteria = new Criteria();
        $criteria->add(SpecificProjectTask::ID_PROJECT_TASK, $idProjectTask, Criteria::EQUAL);
        $specificProjectTaskCollection = $this->getByCriteria($criteria);
        return $specificProjectTaskCollection;
    }

    /**
     * Metodo que regresa una coleccion de objetos SpecificProjectTask con WorkAuthorizationStatus 'Active'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return SpecificProjectTaskCollection $specificProjectTaskCollection
     */
    public function getActives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(SpecificProjectTask::WORK_AUTHORIZATION_STATUS, SpecificProjectTask::$WorkAuthorizationStatus['Active'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }
    
    /**
     * Metodo que regresa una coleccion de objetos SpecificProjectTask con WorkAuthorizationStatus 'Inactive'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return SpecificProjectTaskCollection $specificProjectTaskCollection
     */
    public function getInactives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(SpecificProjectTask::WORK_AUTHORIZATION_STATUS, SpecificProjectTask::$WorkAuthorizationStatus['Inactive'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }
    
    /**
     * Activate a specificProjectTask
     * @param SpecificProjectTask $specificProjectTask
     */ 
    public function activate($specificProjectTask)
    {
        if(!($specificProjectTask instanceof SpecificProjectTask))
            throw new SpecificProjectTaskException("passed parameter isn't a SpecificProjectTask instance");
        if(SpecificProjectTask::$WorkAuthorizationStatus['Active'] != $specificProjectTask->getWorkAuthorizationStatus())
        {
            $specificProjectTask->setWorkAuthorizationStatus(SpecificProjectTask::$WorkAuthorizationStatus['Active']);
            $this->save($specificProjectTask);
        }
    }
    
    /**
     * Deactivate a specificProjectTask
     * @param SpecificProjectTask $specificProjectTask
     */ 
    public function deactivate($specificProjectTask)
    {
        if(!($specificProjectTask instanceof SpecificProjectTask))
            throw new SpecificProjectTaskException("passed parameter isn't a SpecificProjectTask instance");
        if(SpecificProjectTask::$WorkAuthorizationStatus['Inactive'] != $specificProjectTask->getWorkAuthorizationStatus())
        {
            $specificProjectTask->setWorkAuthorizationStatus(SpecificProjectTask::$WorkAuthorizationStatus['Inactive']);
            $this->save($specificProjectTask);
        }
    }


} 
 