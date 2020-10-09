<?php

namespace VgsPedro\WintouchApi\Classes;

use \VgsPedro\WintouchApi\Authentication;

/**
 * A class for CRUD the Users requests
 */

class Users extends Authentication{

	/** @const entity api url */
	const ENTITY = 'users/';

	/**
	User array data structure
	[
		'id' => 0, // int required ON UPDATE
        'code' => 'ADM001', //string required
        'name' => '', //string required
		'tenant_id' => '00000000-0000-0000-0000-000000000000', //string 
        'logged_in_timestamp' => '0001-01-01T00:00:00', // datetime
        'admin_user_security_tokens' => [], //array
        'user_enterprises' => [], //array
        'system_logs' => [], //array
        'is_host' => false, //boolean
        'is_support_account' => false //boolean
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

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name = '')
    {
        $this->name = $name;
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

    private $tenant_id;

    public function getTenantId()
    {
        return $this->tenant_id;
    }

    public function setTenantId(string $tenant_id = '')
    {
        $this->tenant_id = $tenant_id;
    }

    private $logged_in_timestamp;

    public function getLoggedInTimestamp()
    {
        return $this->logged_in_timestamp;
    }

    public function setloggedInTimestamp(string $logged_in_timestamp = '0001-01-01T00:00:00')
    {
        $this->logged_in_timestamp = $logged_in_timestamp;
    }

    private $admin_user_security_tokens;

    public function getAdminUserSecurityTokens()
    {
        return $this->admin_user_security_tokens;
    }

    public function setAdminUserSecurityTokens(array $admin_user_security_tokens = [])
    {
        $this->admin_user_security_tokens = $admin_user_security_tokens;
    }

    private $user_enterprises;

    public function getUserEnterprises()
    {
        return $this->user_enterprises;
    }

    public function setUserEnterprises(array $user_enterprises = [])
    {
        $this->user_enterprises = $user_enterprises;
    }

    private $system_logs;

    public function getSystemLogs()
    {
        return $this->system_logs;
    }

    public function setSystemLogs(array $system_logs = [])
    {
        $this->system_logs = $system_logs;
    }

    private $is_host;

    public function getIsHost()
    {
        return $this->is_host;
    }

    public function setIsHost(bool $is_host = false)
    {
        $this->is_host = $is_host;
    }

    private $is_support_account;

    public function getIsSupportAccount()
    {
        return $this->is_support_account;
    }

    public function setIsSupportAccount(bool $is_support_account =  false)
    {
        $this->is_support_account = $is_support_account;
    }

    /**
    * List all Users
    * @return json 
    **/
    public function list()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY), 'GET', null);
    }

    /**
    * List a User by id
    * @return json 
    **/
    public function listById()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY.''.$this->getId()), 'GET', null);
    }

    /**
    * Create a User
    * @return json 
    **/
    public function insert()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY), 'POST', [
            'param' => 'user',
            'ID' => $this->getId(),
            'Code' => $this->getCode(),
            'Name' => $this->getName(),
            'TenantID' => $this->getTenantId(),
            'LoggedinTimestamp' => $this->getLoggedInTimestamp(),
            'AdminUserSecurityTokens' => $this->getAdminUserSecurityTokens(),
            'UserEnterprises' => $this->getUserEnterprises(),
            'SystemLogs' => $this->getSystemLogs(),
            'IsHost' => $this->getIsHost(),
            'IsSupportAccount' => $this->getIsSupportAccount()
        ]);
    }

    /**
    * Edit a User
    * @return json 
    **/
    public function edit()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY.''.$this->getId()), 'PUT', [
            'param' => 'user',
            'ID' => $this->getId(),
            'Code' => $this->getCode(),
            'Name' => $this->getName(),
            'TenantID' => $this->getTenantId(),
            'LoggedinTimestamp' => $this->getLoggedInTimestamp(),
            'AdminUserSecurityTokens' => $this->getAdminUserSecurityTokens(),
            'UserEnterprises' => $this->getUserEnterprises(),
            'SystemLogs' => $this->getSystemLogs(),
            'IsHost' => $this->getIsHost(),
            'IsSupportAccount' => $this->getIsSupportAccount()
        ]);
    }

    /**
    * Delete a User
    * @return json 
    **/
    public function delete()
    {
        return parent::curlRequest(parent::getPath(static::ENTITY.''.$this->getId()), 'DELETE', null);
    }

}