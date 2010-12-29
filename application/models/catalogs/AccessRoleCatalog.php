<?php
/**
 * ##$BRAND_NAME$## 
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Models
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * Dependences
 */
require_once "lib/db/Catalog.php";
require_once "application/models/beans/AccessRole.php";
require_once "application/models/exceptions/AccessRoleException.php";
require_once "application/models/collections/AccessRoleCollection.php";
require_once "application/models/factories/AccessRoleFactory.php";

/**
 * Singleton AccessRoleCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.0 SVN: $Revision$
 */
class AccessRoleCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var AccessRoleCatalog
     */
    static protected $instance = null;


    /**
     * Método para obtener la instancia del catálogo
     * @return AccessRoleCatalog
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
     * Constructor de la clase AccessRoleCatalog
     * @return AccessRoleCatalog
     */
    protected function AccessRoleCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un AccessRole a la base de datos
     * @param AccessRole $accessRole Objeto AccessRole
     */
    public function create($accessRole)
    {
        if(!($accessRole instanceof AccessRole))
            throw new AccessRoleException("passed parameter isn't a AccessRole instance");
        try
        {
            $data = array(
                'name' => $accessRole->getName(),
                'status' => $accessRole->getStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(AccessRole::TABLENAME, $data);
            $accessRole->setIdAccessRole($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("The AccessRole can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idAccessRole
     * @return AccessRole|null
     */
    public function getById($idAccessRole)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(AccessRole::ID_ACCESS_ROLE, $idAccessRole, Criteria::EQUAL);
            $newAccessRole = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("Can't obtain the AccessRole \n" . $e->getMessage());
        }
        return $newAccessRole;
    }
    
    /**
     * Metodo para Obtener una colección de objetos por varios ids
     * @param array $ids
     * @return AccessRoleCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new AccessRoleCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(AccessRole::ID_ACCESS_ROLE, $ids, Criteria::IN);
            $accessRoleCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("AccessRoleCollection can't be populated\n" . $e->getMessage());
        }
        return $accessRoleCollection;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_access_role FROM '.AccessRole::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("Can't obtain the ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un AccessRole
     * @param AccessRole $accessRole 
     */
    public function update($accessRole)
    {
        if(!($accessRole instanceof AccessRole))
            throw new AccessRoleException("passed parameter isn't a AccessRole instance");
        try
        {
            $where[] = "id_access_role = '{$accessRole->getIdAccessRole()}'";
            $data = array(
                'name' => $accessRole->getName(),
                'status' => $accessRole->getStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(AccessRole::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("The AccessRole can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un accessRole
     * @param AccessRole $accessRole
     */	
    public function save($accessRole)
    {
        if(!($accessRole instanceof AccessRole))
            throw new AccessRoleException("passed parameter isn't a AccessRole instance");
        if(null != $accessRole->getIdAccessRole())
            $this->update($accessRole);
        else
            $this->create($accessRole);
    }

    /**
     * Metodo para eliminar un accessRole
     * @param AccessRole $accessRole
     */
    public function delete($accessRole)
    {
        if(!($accessRole instanceof AccessRole))
            throw new AccessRoleException("passed parameter isn't a AccessRole instance");
        $this->deleteById($accessRole->getIdAccessRole());
    }

    /**
     * Metodo para eliminar un AccessRole a partir de su Id
     * @param int $idAccessRole
     */
    public function deleteById($idAccessRole)
    {
        try
        {
            $where = array($this->db->quoteInto('id_access_role = ?', $idAccessRole));
            $this->db->delete(AccessRole::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("The AccessRole can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios AccessRole a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(AccessRole::ID_ACCESS_ROLE, $ids, Criteria::IN);
            $this->db->delete(AccessRole::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new AccessRoleException("Can't delete that\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de AccessRole por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de AccessRole que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try
        {
            $sql = "SELECT id_access_role
                    FROM ".AccessRole::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $ids = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new AccessRoleException("Can't obtain AccessRole's id\n" . $e->getMessage());
        }
        return $ids;
    }

    /**
     * Metodo para obtener un campo en particular de un AccessRole dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @return array Array con el campo de los objetos AccessRole que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try
        {
            $sql = "SELECT {$field}
                    FROM ".AccessRole::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new AccessRoleException("No se pudieron obtener los ids de objetos {$Bean}\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos AccessRole 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return AccessRoleCollection $accessRoleCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".AccessRole::TABLENAME."
                    WHERE " . $criteria->createSql();
            $accessRoleCollection = new AccessRoleCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $accessRoleCollection->append($this->getAccessRoleInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new AccessRoleException("Cant obtain AccessRoleCollection\n" . $e->getMessage());
        }
        return $accessRoleCollection;
    }
    
    /**
     * Metodo que cuenta AccessRole 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_access_role')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".AccessRole::TABLENAME."
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new AccessRoleException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * Método que construye un objeto AccessRole y lo rellena con la información del rowset
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return AccessRole 
     */
    private function getAccessRoleInstance($result)
    {
        return AccessRoleFactory::createFromArray($result);
    }
  
    /**
     * Obtiene un AccessRole dependiendo del name
     * @param string $name  
     * @return AccessRole 
     */
    public function getByName($name)
    {
        $criteria = new Criteria();
        $criteria->add(AccessRole::NAME, $name, Criteria::EQUAL);
        $accessRoleCollection = $this->getByCriteria($criteria);
        return $accessRoleCollection->getOne();
    }
    
    /**
     * Obtiene o crea un grupo de usuario
     * @param string $name
     * @return AccessRole
     */
    public function getOrCreateByName($name)
    {
		$accessRole = $this->getByName($name);
        if(!($accessRole instanceof AccessRole ))
        {
            $accessRole= AccessRoleFactory::create($name, AccessRole::$Status['Active']);
            $this->create($accessRole);
        }
        return $accessRole;
    }

    /**
     * Metodo que regresa una coleccion de objetos AccessRole con Status 'Active'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return AccessRoleCollection $accessRoleCollection
     */
    public function getActives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(AccessRole::STATUS, AccessRole::$Status['Active'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }
    
    /**
     * Metodo que regresa una coleccion de objetos AccessRole con Status 'Inactive'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return AccessRoleCollection $accessRoleCollection
     */
    public function getInactives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(AccessRole::STATUS, AccessRole::$Status['Inactive'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }
    
    /**
     * Activate a accessRole
     * @param AccessRole $accessRole
     */ 
    public function activate($accessRole)
    {
        if(!($accessRole instanceof AccessRole))
            throw new AccessRoleException("passed parameter isn't a AccessRole instance");
        if(AccessRole::$Status['Active'] != $accessRole->getStatus())
        {
            $accessRole->setStatus(AccessRole::$Status['Active']);
            $this->save($accessRole);
        }
    }
    
    /**
     * Deactivate a accessRole
     * @param AccessRole $accessRole
     */ 
    public function deactivate($accessRole)
    {
        if(!($accessRole instanceof AccessRole))
            throw new AccessRoleException("passed parameter isn't a AccessRole instance");
        if(AccessRole::$Status['Inactive'] != $accessRole->getStatus())
        {
            $accessRole->setStatus(AccessRole::$Status['Inactive']);
            $this->save($accessRole);
        }
    }
    
	/**
	 * Link a AccessRole to SecurityAction
	 * @param int $idAccessRole
	 * @param int $idSecurityAction
	 */
	public function linkToSecurityAction($idAccessRole, $idSecurityAction)
	{
	    try
	    {
	        $this->unlinkFromSecurityAction($idAccessRole, $idSecurityAction);
	        $data = array(
	            'id_access_role' => $idAccessRole,
	            'id_security_action' => $idSecurityAction,
	        );
	        $this->db->insert(AccessRole::TABLENAME_ACCESS_ROLE_SECURITY_ACTION, $data);
	    }
	    catch(Exception $e)
	    {
	        throw new AccessRoleException("The AccessRole can't be saved \n" . $e->getMessage());
	    }
	}
	
	/**
	 * Unlink a AccessRole from SecurityAction
	 * @param int $idAccessRole
	 * @param int $idSecurityAction
	 */
	public function unlinkFromSecurityAction($idAccessRole, $idSecurityAction)
	{
	    try
	    {
	        $where = array(
	            $this->db->quoteInto('id_access_role = ?', $idAccessRole),
	            $this->db->quoteInto('id_security_action = ?', $idSecurityAction),
	        );
	        $this->db->delete(AccessRole::TABLENAME_ACCESS_ROLE_SECURITY_ACTION, $where);
	    }
	    catch(Exception $e)
	    {
	        throw new AccessRoleException("The AccessRole can't be erased \n" . $e->getMessage());
	    }
	}
	
	/**
	 * Unlink all SecurityAction relations
	 * @param int $idAccessRole
	 */
	public function unlinkAllSecurityAction($idAccessRole)
	{
	    try
	    {
	        $where = array(
	            $this->db->quoteInto('id_access_role = ?', $idAccessRole),
	        );
	        $this->db->delete(AccessRole::TABLENAME_ACCESS_ROLE_SECURITY_ACTION, $where);
	    }
	    catch(Exception $e)
	    {
	        throw new AccessRoleException("The AccessRole can't be erased \n" . $e->getMessage());
	    }
	}
	
	/**
	 * Get AccessRole - SecurityAction relations by Criteria
	 * @param Criteria $criteria
	 * @return array 
	 */
	public function getAccessRoleSecurityAction(Criteria $criteria = null)
	{ 
	    $criteria = (null === $criteria) ? new Criteria() : $criteria;
	    $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
	    try
	    {
	       $sql = "SELECT * FROM ". AccessRole::TABLENAME_ACCESS_ROLE_SECURITY_ACTION ."
	               WHERE  " . $criteria->createSql();
	       $result = $this->db->fetchAll($sql);
	    } catch(Exception $e)
	    {
	       throw new AccessRoleException("No se pudieron obtener las relaciones\n" . $e->getMessage());
	    }
	    return $result;
	}
	
	/**
	 * Get a AccessRoleCollection by SecurityAction
	 * @param int $idSecurityAction
	 * @return AccessRoleCollection
	 */
	public function getBySecurityAction($idSecurityAction)
	{
	    $criteria = new Criteria();
	    $criteria->add('id_security_action', $idSecurityAction, Criteria::EQUAL);
	    $accessRoleSecurityAction = $this->getAccessRoleSecurityAction($criteria);
	    $ids = array();
	    foreach($accessRoleSecurityAction as $rs){
	        $ids[] = $rs['id_access_role'];
	    }
	    return $this->getByIds($ids);
	}
	    
	/**
     * Obtiene la relacion entre access_roles y security_actions
     * @return array
     */
    public function getAllPermissions()
    {
    	$permissions = array();
    	foreach($this->getAccessRoleSecurityAction() as $accessRoleSecurityAction){
    		$permissions[$accessRoleSecurityAction['id_security_action']][$accessRoleSecurityAction['id_access_role']] = 1;
    	}
    	return $permissions;
    }

} 
 