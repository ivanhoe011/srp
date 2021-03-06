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

/**
 * Clase MenuItem
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code) 
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.0 SVN: $Revision$
 */
class MenuItem
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_common_menu_items";
    const ID_MENU_ITEM = "pcs_common_menu_items.id_menu_item";
    const ID_ACTION = "pcs_common_menu_items.id_action";
    const ID_PARENT = "pcs_common_menu_items.id_parent";
    const NAME = "pcs_common_menu_items.name";
    const ORDER = "pcs_common_menu_items.order";

    /**
     * $idMenuItem 
     * 
     * @var int $idMenuItem
     */
    private $idMenuItem;
    /**
     * $idAction 
     * 
     * @var int $idAction
     */
    private $idAction;
    /**
     * $idParent 
     * 
     * @var int $idParent
     */
    private $idParent;
    /**
     * $name 
     * 
     * @var string $name
     */
    private $name;
    /**
     * $order 
     * 
     * @var int $order
     */
    private $order;

    /**
     * Set the idMenuItem value
     * 
     * @param int idMenuItem
     * @return MenuItem $menuItem
     */
    public function setIdMenuItem($idMenuItem)
    {
        $this->idMenuItem = $idMenuItem;
        return $this;
    }

    /**
     * Return the idMenuItem value
     * 
     * @return int
     */
    public function getIdMenuItem()
    {
        return $this->idMenuItem;
    }

    /**
     * Set the idAction value
     * 
     * @param int idAction
     * @return MenuItem $menuItem
     */
    public function setIdAction($idAction)
    {
        $this->idAction = $idAction;
        return $this;
    }

    /**
     * Return the idAction value
     * 
     * @return int
     */
    public function getIdAction()
    {
        return $this->idAction;
    }

    /**
     * Set the idParent value
     * 
     * @param int idParent
     * @return MenuItem $menuItem
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;
        return $this;
    }

    /**
     * Return the idParent value
     * 
     * @return int
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set the name value
     * 
     * @param string name
     * @return MenuItem $menuItem
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Return the name value
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the order value
     * 
     * @param int order
     * @return MenuItem $menuItem
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Return the order value
     * 
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

}
