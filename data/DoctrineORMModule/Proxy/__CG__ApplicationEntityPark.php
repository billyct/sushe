<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Park extends \Application\Entity\Park implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function getBuilds()
    {
        $this->__load();
        return parent::getBuilds();
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function setBuilds($builds)
    {
        $this->__load();
        return parent::setBuilds($builds);
    }

    public function setUser($user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getCreate_at()
    {
        $this->__load();
        return parent::getCreate_at();
    }

    public function setCreate_at($create_at)
    {
        $this->__load();
        return parent::setCreate_at($create_at);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'name', 'id', 'create_at', 'builds', 'user');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}