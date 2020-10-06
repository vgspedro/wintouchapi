<?php

namespace VgsPedro\WintouchApi\Classes;

use \VgsPedro\WintouchApi\Authentication;

/**
 * A class for CRUD the Users requests
 */

class Users extends Authentication{

	/** @const entity api url */
	const ENTITY = '/users/';
	/** @const access api url */
	const ACCESS = '/?access_token=';
	
	/**
	User array data structure
	[
		'user_id' => 0, // int required ON UPDATE
		'code' => 'ADM001', //string required
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

    public function setId(int $id = 0)
    {
        $this->id = $id;
    }

    private $code;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code = null)
    {
        $this->code = $code;
    }

    private $tenant_id;

    public function getTenantId()
    {
        return $this->tenant_id;
    }

    public function setTenantId(string $tenant_id = null)
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

    public function getUserEnterprises()
    {
        return $this->user_enterprises;
    }

    public function setUserEnterprises(array $user_enterprises = [])
    {
        $this->user_enterprises = $user_enterprises;
    }

    public function getSystemLogs()
    {
        return $this->system_logs;
    }

    public function setSystemLogs(array $system_logs = [])
    {
        $this->system_logs = $system_logs;
    }

    public function getIsHost()
    {
        return $this->is_host;
    }

    public function setIsHost(boolean $is_host = false)
    {
        $this->is_host = $is_host;
    }

    public function getIsSupportAccount()
    {
        return $this->is_support_account;
    }

    public function setIsAupportAccount(boolean $is_support_account = false)
    {
        $this->is_support_account = $is_support_account;
    }

    /**
    * Create a new user in database
    * @return json 
    **/
    public function insert()
    {
        return parent::curl(parent::getPath('users'), [
            'setCode' => $this->getCode(),
            'setName' => $this->getName(),
            'TenantID' => $this->getTenantId(),
            'LoggedinTimestamp' => $this->getLoggedInTimestamp(),
            'AdminUserSecurityTokens' => $this->getAdminUserSecurityTokens(),
            'UserEnterprises' => $this->getUserEnterprises(),
            'SystemLogs' => $this->getSystemLogs(),
            'IsHost' => $this->getIsHost(),
            'IsSupportAccount' => $this->getIsSupportAccount(),
        ]);
    }

	/**
	* Get a security Tokens 
	* @return json
	**/
	public function securityTokens()
    {	
		return parent::curl(parent::getPath($this->getId().'/securitytokens')
	}



	
	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getAll()
    {
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId()
		]); 
	}

	

	/**
	* Get Customer by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getById()
	{
		return parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $this->getId()
		]);
	}

	/**
	* Get Customer by Vat
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	public function getByVat()
	{
		return  parent::curl(parent::getPath('getByVat'), [
			'company_id' => parent::getCompanyId(),
			'vat' => $this->getVat()
		]);
	}

	/**
	* Update Customer by Id
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $this->getId(),
			'vat' => $this->getVat(), 
			'number' => $this->getNumber(),
			'name' => $this->getName(),
			'language_id' => $this->getLanguageId(),
			'address' => $this->getAddress(),
			'zip_code' => $this->getZipCode(),
			'city' => $this->getCity(),
			'country_id' => $this->getCountryId(),
			'email' => $this->getEmail(),
			'website' => $this->getWebsite(),
			'phone' => $this->getPhone(),
			'fax' => $this->getFax(),
			'contact_name' => $this->getContactName(),
			'contact_email' => $this->getContactEmail(),
			'contact_phone' => $this->getContactPhone(),
			'notes' => $this->getNotes(),
			'salesman_id' => $this->getSalesmanId(),
			'price_class_id' => $this->getPriceClassId(),
			'maturity_date_id' => $this->getMaturityDateId(),
			'payment_day' => $this->getPaymentDay(),
			'discount' => $this->getDiscount(),
			'credit_limit' => $this->getCreditLimit(),
			'copies'=> [
				'document_type_id' => $this->getCopiesDocumentTypeId(),
				'copies' => $this->getCopiesCopies()
			],
			'payment_method_id' => $this->getPaymentMethodId(),
			'delivery_method_id' => $this->getDeliveryMethodId(),
			'field_notes' => $this->getFieldNotes()
		]);
	}

	/**
	* Delete Customer by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=206
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $this->getId()
		]);
	}

}