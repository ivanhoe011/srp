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
require_once "application/models/beans/Email.php";
require_once "application/models/exceptions/EmailException.php";
require_once "application/models/collections/EmailCollection.php";
require_once "application/models/factories/EmailFactory.php";

/**
 * Singleton EmailCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class EmailCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var EmailCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return EmailCatalog
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
     * Constructor de la clase EmailCatalog
     * @return EmailCatalog
     */
    protected function EmailCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un Email a la base de datos
     * @param Email $email Objeto Email
     */
    public function create($email)
    {
        if(!($email instanceof Email))
            throw new EmailException("passed parameter isn't a Email instance");
        try
        {
            $data = array(
                'id_person' => $email->getIdPerson(),
                'email' => $email->getEmail(),
                'type' => $email->getType(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(Email::TABLENAME, $data);
            $email->setIdEmail($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new EmailException("The Email can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idEmail
     * @param boolean $throw
     * @return Email|null
     */
    public function getById($idEmail, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(Email::ID_EMAIL, $idEmail, Criteria::EQUAL);
            $newEmail = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new EmailException("Can't obtain the Email \n" . $e->getMessage());
        }
        if($throw && null == $newEmail)
            throw new EmailException("The Email at $idEmail not exists ");
        return $newEmail;
    }
    
    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return EmailCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new EmailCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(Email::ID_EMAIL, $ids, Criteria::IN);
            $emailCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new EmailException("EmailCollection can't be populated\n" . $e->getMessage());
        }
        return $emailCollection;
    }

    /**
     * Metodo para actualizar un Email
     * @param Email $email 
     */
    public function update($email)
    {
        if(!($email instanceof Email))
            throw new EmailException("passed parameter isn't a Email instance");
        try
        {
            $where[] = "id_email = '{$email->getIdEmail()}'";
            $data = array(
                'id_person' => $email->getIdPerson(),
                'email' => $email->getEmail(),
                'type' => $email->getType(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(Email::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new EmailException("The Email can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un email
     * @param Email $email
     */	
    public function save($email)
    {
        if(!($email instanceof Email))
            throw new EmailException("passed parameter isn't a Email instance");
        if(null != $email->getIdEmail())
            $this->update($email);
        else
            $this->create($email);
    }

    /**
     * Metodo para eliminar un email
     * @param Email $email
     */
    public function delete($email)
    {
        if(!($email instanceof Email))
            throw new EmailException("passed parameter isn't a Email instance");
        $this->deleteById($email->getIdEmail());
    }

    /**
     * Metodo para eliminar un Email a partir de su Id
     * @param int $idEmail
     */
    public function deleteById($idEmail)
    {
        try
        {
            $where = array($this->db->quoteInto('id_email = ?', $idEmail));
            $this->db->delete(Email::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new EmailException("The Email can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios Email a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(Email::ID_EMAIL, $ids, Criteria::IN);
            $this->db->delete(Email::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new EmailException("Can't delete that\n" . $e->getMessage());
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
     * Metodo para obtener todos los id de Email por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de Email que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(Email::ID_EMAIL, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un Email dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos Email que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".Email::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new EmailException("No se pudieron obtener los fields de objetos Email\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos Email 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return EmailCollection $emailCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".Email::TABLENAME."
                    WHERE " . $criteria->createSql();
            $emailCollection = new EmailCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $emailCollection->append($this->getEmailInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new EmailException("Cant obtain EmailCollection\n" . $e->getMessage());
        }
        return $emailCollection;
    }
    
    /**
     * Metodo que cuenta Email 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_email')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".Email::TABLENAME."
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new EmailException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * M�todo que construye un objeto Email y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return Email 
     */
    private function getEmailInstance($result)
    {
        return EmailFactory::createFromArray($result);
    }
  
    /**
     * Obtiene un EmailCollection  dependiendo del idPerson
     * @param int $idPerson  
     * @return EmailCollection 
     */
    public function getByIdPerson($idPerson)
    {
        $criteria = new Criteria();
        $criteria->add(Email::ID_PERSON, $idPerson, Criteria::EQUAL);
        $emailCollection = $this->getByCriteria($criteria);
        return $emailCollection;
    }


} 
 