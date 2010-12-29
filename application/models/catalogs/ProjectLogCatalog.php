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
require_once "application/models/beans/ProjectLog.php";
require_once "application/models/exceptions/ProjectLogException.php";
require_once "application/models/collections/ProjectLogCollection.php";
require_once "application/models/factories/ProjectLogFactory.php";

/**
 * Singleton ProjectLogCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectLogCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var ProjectLogCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return ProjectLogCatalog
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
     * Constructor de la clase ProjectLogCatalog
     * @return ProjectLogCatalog
     */
    protected function ProjectLogCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un ProjectLog a la base de datos
     * @param ProjectLog $projectLog Objeto ProjectLog
     */
    public function create($projectLog)
    {
        if(!($projectLog instanceof ProjectLog))
            throw new ProjectLogException("passed parameter isn't a ProjectLog instance");
        try
        {
            $data = array(
                'id_project' => $projectLog->getIdProject(),
                'timestamp' => $projectLog->getTimestamp(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(ProjectLog::TABLENAME, $data);
            $projectLog->setIdProjectLog($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new ProjectLogException("The ProjectLog can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idProjectLog
     * @param boolean $throw
     * @return ProjectLog|null
     */
    public function getById($idProjectLog, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectLog::ID_PROJECT_LOG, $idProjectLog, Criteria::EQUAL);
            $newProjectLog = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new ProjectLogException("Can't obtain the ProjectLog \n" . $e->getMessage());
        }
        if($throw && null == $newProjectLog)
            throw new ProjectLogException("The ProjectLog at $idProjectLog not exists ");
        return $newProjectLog;
    }
    
    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return ProjectLogCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new ProjectLogCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectLog::ID_PROJECT_LOG, $ids, Criteria::IN);
            $projectLogCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new ProjectLogException("ProjectLogCollection can't be populated\n" . $e->getMessage());
        }
        return $projectLogCollection;
    }

    /**
     * Metodo para actualizar un ProjectLog
     * @param ProjectLog $projectLog 
     */
    public function update($projectLog)
    {
        if(!($projectLog instanceof ProjectLog))
            throw new ProjectLogException("passed parameter isn't a ProjectLog instance");
        try
        {
            $where[] = "id_project_log = '{$projectLog->getIdProjectLog()}'";
            $data = array(
                'id_project' => $projectLog->getIdProject(),
                'timestamp' => $projectLog->getTimestamp(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(ProjectLog::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectLogException("The ProjectLog can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un projectLog
     * @param ProjectLog $projectLog
     */	
    public function save($projectLog)
    {
        if(!($projectLog instanceof ProjectLog))
            throw new ProjectLogException("passed parameter isn't a ProjectLog instance");
        if(null != $projectLog->getIdProjectLog())
            $this->update($projectLog);
        else
            $this->create($projectLog);
    }

    /**
     * Metodo para eliminar un projectLog
     * @param ProjectLog $projectLog
     */
    public function delete($projectLog)
    {
        if(!($projectLog instanceof ProjectLog))
            throw new ProjectLogException("passed parameter isn't a ProjectLog instance");
        $this->deleteById($projectLog->getIdProjectLog());
    }

    /**
     * Metodo para eliminar un ProjectLog a partir de su Id
     * @param int $idProjectLog
     */
    public function deleteById($idProjectLog)
    {
        try
        {
            $where = array($this->db->quoteInto('id_project_log = ?', $idProjectLog));
            $this->db->delete(ProjectLog::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectLogException("The ProjectLog can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios ProjectLog a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectLog::ID_PROJECT_LOG, $ids, Criteria::IN);
            $this->db->delete(ProjectLog::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new ProjectLogException("Can't delete that\n" . $e->getMessage());
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
     * Metodo para obtener todos los id de ProjectLog por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de ProjectLog que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(ProjectLog::ID_PROJECT_LOG, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un ProjectLog dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos ProjectLog que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".ProjectLog::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new ProjectLogException("No se pudieron obtener los fields de objetos ProjectLog\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos ProjectLog 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return ProjectLogCollection $projectLogCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".ProjectLog::TABLENAME."
                    WHERE " . $criteria->createSql();
            $projectLogCollection = new ProjectLogCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $projectLogCollection->append($this->getProjectLogInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new ProjectLogException("Cant obtain ProjectLogCollection\n" . $e->getMessage());
        }
        return $projectLogCollection;
    }
    
    /**
     * Metodo que cuenta ProjectLog 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_project_log')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".ProjectLog::TABLENAME."
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new ProjectLogException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * M�todo que construye un objeto ProjectLog y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return ProjectLog 
     */
    private function getProjectLogInstance($result)
    {
        return ProjectLogFactory::createFromArray($result);
    }
  
    /**
     * Obtiene un ProjectLogCollection  dependiendo del idProject
     * @param int $idProject  
     * @return ProjectLogCollection 
     */
    public function getByIdProject($idProject)
    {
        $criteria = new Criteria();
        $criteria->add(ProjectLog::ID_PROJECT, $idProject, Criteria::EQUAL);
        $projectLogCollection = $this->getByCriteria($criteria);
        return $projectLogCollection;
    }


} 
 