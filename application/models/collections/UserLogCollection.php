<?php
/**
 * Bender Modeler
 *
 * Our Simple Models
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @author     <zetta> <chentepixtol>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */


require_once "lib/utils/Parser.php";

/**
 * Clase UserLogCollection que representa una collección de objetos UserLog
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_collections
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.0 SVN: $Revision$
 */
class UserLogCollection extends ArrayIterator
{

    /**
     * @var Parser
     */
    private $parser;
    
    /**
     * Constructor
     * @param array $array
     * @return void
     */
    public function __construct($array = array())
    {
        $this->parser = new Parser('UserLog');
        parent::__construct($array);
    }

    /**
     * Appends the value
     * @param UserLog $userLog
     */
    public function append(UserLog $userLog)
    {
        parent::offsetSet($userLog->getIdUserLog(), $userLog);
        $this->rewind();
    }

    /**
     * Return current array entry
     * @return UserLog
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and 
     * move to next entry
     * @return UserLog 
     */
    public function read()
    {
        $userLog = $this->current();
        $this->next();
        return $userLog;
    }

    /**
     * Get the first array entry
     * if exists or null if not 
     * @return UserLog|null 
     */
    public function getOne()
    {
        if ($this->count() > 0)
        {
            $this->seek(0);
            return $this->current();
        } else
            return null;
    }
    
    /**
     * Contains one object with $idUserLog
     * @param  int $idUserLog
     * @return boolean
     */
    public function contains($idUserLog)
    {
        return parent::offsetExists($idUserLog);
    }
    
    /**
     * Merge two Collections
     * @param UserLogCollection $userLogCollection
     * @return void
     */
    public function merge(UserLogCollection $userLogCollection)
    {
        while($userLogCollection->valid())
        {
            $userLog = $userLogCollection->read();
            if( !$this->contains( $userLog->getIdUserLog() ) )
            {
                $this->append($userLog);
            }             
        }
        $userLogCollection->rewind();
    }
    
    /**
     * Retrieve the array with primary keys 
     * @return array
     */
    public function getPrimaryKeys()
    {
        return array_keys($this->getArrayCopy());
    }
    
  
    /**
     * Transforma una collection a un array
     * @return array
     */
    public function toArray()
    {
        $array = array();
        while ($this->valid())
        {
            $userLog = $this->read();
            $this->parser->changeBean($userLog);
            $array[$userLog->getIdUserLog()] = $this->parser->toArray();
        }
        $this->rewind();
        return $array;
    }
    
    /**
     * Crea un array asociativo de $key => $value a partir de las constantes de un bean
     * @param string $ckey
     * @param string $cvalue
     * @return array
     */
    public function toKeyValueArray($ckey, $cvalue)
    {
        $array = array();
        while ($this->valid())
        {
            $userLog = $this->read();
            $this->parser->changeBean($userLog);
            $array += $this->parser->toKeyValueArray($ckey, $cvalue);
        }
        $this->rewind();
        return $array;
    }
    
    /**
     * Retrieve the parser object
     * @return Parser
     */
    public function getParser()
    {
        return $this->parser;
    }
  
  
}
