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


require_once "lib/utils/Parser.php";

/**
 * Clase SpecificProjectTaskCollection que representa una collecci�n de objetos SpecificProjectTask
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_collections
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class SpecificProjectTaskCollection extends ArrayIterator
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
        $this->parser = new Parser('SpecificProjectTask');
        parent::__construct($array);
    }

    /**
     * Appends the value
     * @param SpecificProjectTask $specificProjectTask
     */
    public function append($specificProjectTask)
    {
        parent::offsetSet($specificProjectTask->getIdSpecificProjectTask(), $specificProjectTask);
        $this->rewind();
    }

    /**
     * Return current array entry
     * @return SpecificProjectTask
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and 
     * move to next entry
     * @return SpecificProjectTask 
     */
    public function read()
    {
        $specificProjectTask = $this->current();
        $this->next();
        return $specificProjectTask;
    }

    /**
     * Get the first array entry
     * if exists or null if not 
     * @return SpecificProjectTask|null 
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
     * Contains one object with $idSpecificProjectTask
     * @param  int $idSpecificProjectTask
     * @return boolean
     */
    public function contains($idSpecificProjectTask)
    {
        return parent::offsetExists($idSpecificProjectTask);
    }
    
    /**
     * Remove one object with $idSpecificProjectTask
     * @param  int $idSpecificProjectTask
     */
    public function remove($idSpecificProjectTask)
    {
        if( $this->contains($idSpecificProjectTask) )
            $this->offsetUnset($idSpecificProjectTask);
    }
    
    /**
     * Merge two Collections
     * @param SpecificProjectTaskCollection $specificProjectTaskCollection
     * @return void
     */
    public function merge(SpecificProjectTaskCollection $specificProjectTaskCollection)
    {
        $specificProjectTaskCollection->rewind();
        while($specificProjectTaskCollection->valid())
        {
            $specificProjectTask = $specificProjectTaskCollection->read();
            if( !$this->contains( $specificProjectTask->getIdSpecificProjectTask() ) )
                $this->append($specificProjectTask);
        }
        $specificProjectTaskCollection->rewind();
    }
    
    /**
     * Diff two Collections
     * @param SpecificProjectTaskCollection $specificProjectTaskCollection
     * @return void
     */
    public function diff(SpecificProjectTaskCollection $specificProjectTaskCollection)
    {
        $specificProjectTaskCollection->rewind();
        while($specificProjectTaskCollection->valid())
        {
            $specificProjectTask = $specificProjectTaskCollection->read();
            if( $this->contains( $specificProjectTask->getIdSpecificProjectTask() ) )
                $this->remove($specificProjectTask->getIdSpecificProjectTask());     
        }
        $specificProjectTaskCollection->rewind();
    }
    
    /**
     * Intersect two Collections
     * @param SpecificProjectTaskCollection $specificProjectTaskCollection
     * @return SpecificProjectTaskCollection
     */
    public function intersect(SpecificProjectTaskCollection $specificProjectTaskCollection)
    {
        $newspecificProjectTaskCollection = SpecificProjectTaskCollection();
        $specificProjectTaskCollection->rewind();
        while($specificProjectTaskCollection->valid())
        {
            $specificProjectTask = $specificProjectTaskCollection->read();
            if( $this->contains( $specificProjectTask->getIdSpecificProjectTask() ) )
                $newspecificProjectTaskCollection->append($specificProjectTask);
        }
        $specificProjectTaskCollection->rewind();
        return $newspecificProjectTaskCollection;
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
     * Retrieve the SpecificProjectTask with primary key  
     * @param  int $idSpecificProjectTask
     * @return SpecificProjectTask
     */
    public function getByPK($idSpecificProjectTask)
    {
        return $this->contains($idSpecificProjectTask) ? $this[$idSpecificProjectTask] : null;
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
            $specificProjectTask = $this->read();
            $this->parser->changeBean($specificProjectTask);
            $array[$specificProjectTask->getIdSpecificProjectTask()] = $this->parser->toArray();
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
            $specificProjectTask = $this->read();
            $this->parser->changeBean($specificProjectTask);
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
    
    /**
     * Is Empty
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->count() == 0;
    }
  
  
}
