<?php

namespace VgsPedro\WintouchApi\Classes;

use \VgsPedro\WintouchApi\Authentication;

/**
 * A class for CRUD the Languages
 */

class Languages extends Authentication{

	/** @const entity api url */
	const ENTITY = 'languages/';
	
	/**
	Language array data structure
	[
		'ID' => 0, // int required ON UPDATE
		'Code' => 'PT', //string required
		'Name' => 'Português', //string required
	]
    **/
	
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id = '')
    {
        $this->id = $id;
    }

    private $code;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code = '')
    {
        $this->code = $code;
    }

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name = '')
    {
        $this->name = $name;
    }

    /**
    * List all Languages
    * @return json 
    **/
    public function list()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY), 'GET', null);
    }

    /**
    * List a Language by id
    * @return json 
    **/
    public function listById()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY.''.$this->getId()), 'GET', null);
    }

    /**
    * Create a Language
    * @return json 
    **/
    public function insert()
    {
        return parent::curl(parent::getPath(static::ENTITY), 'POST', [
            'Code' => $this->getCode(),
            'Name' => $this->getName()
        ]);
    }

    /**
    * Edit a Language
    * @return json 
    **/
    public function edit()
    {
        return parent::curl(parent::getPath(static::ENTITY.''.$this->getId()), 'PUT', [
            'ID' => $this->getId(),
            'Code' => $this->getCode(),
            'Name' => $this->getName()
        ]);
    }

    /**
    * Delete a Language
    * @return json 
    **/
    public function delete()
    {
        return parent::curl(parent::getPath(static::ENTITY.''.$this->getId()), 'DELETE', null);
    }

}