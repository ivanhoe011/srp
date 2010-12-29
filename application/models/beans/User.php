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
require_once "application/models/beans/Person.php";

/**
 * Clase User
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class User extends Person 
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_common_users";

    /**
     * Constantes para los nombres de los campos
     */
    const ID_USER = "pcs_common_users.id_user";
    const USERNAME = "pcs_common_users.username";
    const PASSWORD = "pcs_common_users.password";
    const STATUS = "pcs_common_users.status";
    const ID_ACCESS_ROLE = "pcs_common_users.id_access_role";
    const ID_PERSON = "pcs_common_users.id_person";
    const SYSTEM = "pcs_common_users.system";
    

    /**
     * $idUser 
     * 
     * @var int $idUser
     */
    private $idUser;
    

    /**
     * $username 
     * 
     * @var string $username
     */
    private $username;
    

    /**
     * $password 
     * 
     * @var string $password
     */
    private $password;
    

    /**
     * $status 
     * 
     * @var int $status
     */
    private $status;
    

    /**
     * $idAccessRole 
     * 
     * @var int $idAccessRole
     */
    private $idAccessRole;
    

    /**
     * $idPerson 
     * 
     * @var int $idPerson
     */
    private $idPerson;
    

    /**
     * $system 
     * 
     * @var int $system
     */
    private $system;

    /**
     * Set the idUser value
     * 
     * @param int idUser
     * @return User $user
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * Return the idUser value
     * 
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the username value
     * 
     * @param string username
     * @return User $user
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Return the username value
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the password value
     * 
     * @param string password
     * @return User $user
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Return the password value
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the status value
     * 
     * @param int status
     * @return User $user
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Return the status value
     * 
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the idAccessRole value
     * 
     * @param int idAccessRole
     * @return User $user
     */
    public function setIdAccessRole($idAccessRole)
    {
        $this->idAccessRole = $idAccessRole;
        return $this;
    }

    /**
     * Return the idAccessRole value
     * 
     * @return int
     */
    public function getIdAccessRole()
    {
        return $this->idAccessRole;
    }

    /**
     * Set the idPerson value
     * 
     * @param int idPerson
     * @return User $user
     */
    public function setIdPerson($idPerson)
    {
        $this->idPerson = $idPerson;
        return $this;
    }

    /**
     * Return the idPerson value
     * 
     * @return int
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }

    /**
     * Set the system value
     * 
     * @param int system
     * @return User $user
     */
    public function setSystem($system)
    {
        $this->system = $system;
        return $this;
    }

    /**
     * Return the system value
     * 
     * @return int
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Status
     * @var Array
     */
    public static $Status = array(
        'Active' => 1,
        'Inactive' => 2,
    );
    
    /**
     * Status Labels
     * @var Array
     */
    public static $StatusLabel = array(
        1 => 'Activo',
        2 => 'Inactivo',
    );
}