<?php

namespace AppBundle\Entity;

/**
 * Court
 */
class Court
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $active = true;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Court
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
    
    public function __toString() {
        return strval($this->id);
    }
}

