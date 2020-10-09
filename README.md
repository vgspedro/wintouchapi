
# Wintouch V1 API PHP Wrapper Library

## Work in progress.

## How to use

This library is installed via [Composer](http://getcomposer.org/).

composer require vgspedro/wintouchapi:dev-main

## Symfony framework

#### Create the Route

# config/routes.yaml

```
invoice:
    path: /admin/wintouchinvoice
    controller: App\Controller\InvoiceWintouchController::index
```

#### Create the Controler

# src/Controler/InvoicingWintouchController.php

```php

  private $environment;

    
    public function __construct(ParameterBagInterface $environment)
    {
        $this->environment = $environment;
    }

    public function index(InvoiceWintouch $wintouch)
    {
        return $this->render('native.html', [
            // Invoice
            'wintouch' => [
                'list_users' => $wintouch->listUsers(),
                'create_user' => $wintouch->createUser($this->createUser())

            ],
            'sf_v' => \Symfony\Component\HttpKernel\Kernel::VERSION
        ]);
    }
  


    private function createUser(){ 
        return [
            'id' => 0, // int required ON UPDATE
            'name' => 'System Administrator',
            'code' => 'ADM001', //string required
            'tenant_id' => 'd2933578-a571-4be5-ba7d-84f696f5b005', //string 
            'logged_in_timestamp' => '0001-01-01T00:00:00', // datetime
            'admin_user_security_tokens' => [], //array
            'user_enterprises' => [], //array
            'system_logs' => [], //array
            'is_host' => false, //boolean
            'is_support_account' => false //boolean
        ];
    }
}

```

#### Create the Service

# src/Service/InvoiceWintouch.php

```php
namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use \VgsPedro\WintouchApi\Authentication;
use \VgsPedro\WintouchApi\Classes\Users;
use \VgsPedro\WintouchApi\Classes\Languages;


class InvoiceWintouch
{
	private $credencials;
	private $session;

    public function __construct(ParameterBagInterface $environment, SessionInterface $session){

		$this->credencials = [];

		if($environment->get("kernel.environment") == 'prod'){
			$this->credencials['user_enterprise'] = 'xxx'; //Change according to specific user, not needed if api 
			$this->credencials['authorization'] = 'Apikey dmdzcGVkcm9AZ21haWwuY29tLGUxMmE0MzhmLWQ3OTItNGZkYi05MTcxLTc1MTQ2YjI3NTQxYQ=='; // Api Key Given by Wintouch 
		 	$this->credencials['url'] = 'https://api.wintouchcloud.com:443/api/'; // Url to make request, sandbox or live (sandbox APP_ENV=dev or test) (live APP_ENV=prod)
		}
		else{
			$this->credencials['user_enterprise'] = 'xxx'; //Change according to specific user, not needed if api 
			$this->credencials['authorization'] = 'Apikey dmdzcGVkcm9AZ21haWwuY29tLGUxMmE0MzhmLWQ3OTItNGZkYi05MTcxLTc1MTQ2YjI3NTQxYQ=='; // Api Key Given by Wintouch 
		 	$this->credencials['url'] = 'https://api.wintouchcloud.com:443/api/'; // Url to make request, sandbox or live (sandbox APP_ENV=dev or test) (live APP_ENV=prod)
		}
		//$this->credencials['token']['access_token'] = '';
		$this->credencials['api_version'] = 'v1/';
    }

	#####
	## USERS METHODS
	#####

	public function listUsers(){

		$u = new Users();

 		$u->setUrl($this->credencials['url']);
		$u->setApiVersion($this->credencials['api_version']);
 		$u->setAuthorization($this->credencials['authorization']);
		
		return $u->list();
	}

	
	public function listUserById(string $user_id){

		$u = new Users();
 		
 		$u->setId($user_id);
 		$u->setUrl($this->credencials['url']);
		$u->setApiVersion($this->credencials['api_version']);
 		$u->setAuthorization($this->credencials['authorization']);
		
		return $u->listById();
	}

	public function createUser(array $user = []){

		$u = new Users();

 		$u->setUrl($this->credencials['url']);
		$u->setApiVersion($this->credencials['api_version']);
 		$u->setAuthorization($this->credencials['authorization']);
 		$u->setCode($user['code']);
 		$u->setName('System Administrator');
 		$u->setTenantID($user['tenant_id']);
 		$u->setLoggedinTimestamp($user['logged_in_timestamp']);
 		$u->setAdminUserSecurityTokens($user['admin_user_security_tokens']);
 		$u->setUserEnterprises($user['user_enterprises']);
 		$u->setSystemLogs($user['system_logs']);
 		$u->setIsHost($user['is_host']);
 		$u->setIsSupportAccount($user['is_support_account']);

 		return $u->insert();
	}

	public function editUser(array $user = []){

		$u = new Users();
 		
 		$u->setId($user['id']);
 		$u->setUrl($this->credencials['url']);
		$u->setApiVersion($this->credencials['api_version']);
 		$u->setAuthorization($this->credencials['authorization']);
 		$u->setCode($user['code']);
 		$u->setName($user['name']);
 		$u->setTenantID($user['tenant_id']);
 		$u->setLoggedinTimestamp($user['logged_in_timestamp']);
 		$u->setAdminUserSecurityTokens($user['admin_user_security_tokens']);
 		$u->setUserEnterprises($user['user_enterprises']);
 		$u->setSystemLogs($user['system_logs']);
 		$u->setIsHost($user['is_host']);
 		$u->setIsSupportAccount($user['is_support_account']);

 		return $u->edit();
	}

	public function deleteUser(string $user_id){

		$u = new Users();
 		
 		$u->setId($user_id);
 		$u->setUrl($this->credencials['url']);
		$u->setApiVersion($this->credencials['api_version']);
 		$u->setAuthorization($this->credencials['authorization']);
		
		return $u->delete();
	}


	#####
	## LANGUAGE METHODS
	#####

	public function listLanguages(){}

}
```


#### Create the Template

# templates/admin/payment/native.html

```html
<h2>Result</h2>
{{dump(moloni)}}

```
