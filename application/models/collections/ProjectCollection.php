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
 * Clase ProjectCollection que representa una collecci�n de objetos Project
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_collections
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectCollection extends ArrayIterator
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
        $this->parser = new Parser('Project');
        parent::__construct($array);
    }

    /**
     * Appends the value
     * @param Project $project
     */
    public function append($project)
    {
        parent::offsetSet($project->getIdProject(), $project);
        $this->rewind();
    }

    /**
     * Return current array entry
     * @return Project
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and 
     * move to next entry
     * @return Project 
     */
    public function read()
    {
        $project = $this->current();
        $this->next();
        return $project;
    }

    /**
     * Get the first array entry
     * if exists or null if not 
     * @return Project|null 
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
     * Contains one object with $idProject
     * @param  int $idProject
     * @return boolean
     */
    public function contains($idProject)
    {
        return parent::offsetExists($idProject);
    }
    
    /**
     * Remove one object with $idProject
     * @param  int $idProject
     */
    public function remove($idProject)
    {
        if( $this->contains($idProject) )
            $this->offsetUnset($idProject);
    }
    
    /**
     * Merge two Collections
     * @param ProjectCollection $projectCollection
     * @return void
     */
    public function merge(ProjectCollection $projectCollection)
    {
        $projectCollection->rewind();
        while($projectCollection->valid())
        {
            $project = $projectCollection->read();
            if( !$this->contains( $project->getIdProject() ) )
                $this->append($project);
        }
        $projectCollection->rewind();
    }
    
    /**
     * Diff two Collections
     * @param ProjectCollection $projectCollection
     * @return void
     */
    public function diff(ProjectCollection $projectCollection)
    {
        $projectCollection->rewind();
        while($projectCollection->valid())
        {
            $project = $projectCollection->read();
            if( $this->contains( $project->getIdProject() ) )
                $this->remove($project->getIdProject());     
        }
        $projectCollection->rewind();
    }
    
    /**
     * Intersect two Collections
     * @param ProjectCollection $projectCollection
     * @return ProjectCollection
     */
    public function intersect(ProjectCollection $projectCollection)
    {
        $newprojectCollection = ProjectCollection();
        $projectCollection->rewind();
        while($projectCollection->valid())
        {
            $project = $projectCollection->read();
            if( $this->contains( $project->getIdProject() ) )
                $newprojectCollection->append($project);
        }
        $projectCollection->rewind();
        return $newprojectCollection;
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
     * Retrieve the Project with primary key  
     * @param  int $idProject
     * @return Project
     */
    public function getByPK($idProject)
    {
        return $this->contains($idProject) ? $this[$idProject] : null;
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
            $project = $this->read();
            $this->parser->changeBean($project);
            $array[$project->getIdProject()] = $this->parser->toArray();
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
            $project = $this->read();
            $this->parser->changeBean($project);
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
