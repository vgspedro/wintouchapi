<?php

namespace VgsPedro\WintouchApi;

class Authentication
{

	private $user_credentials;

    public function getUserCredentials()
    {
        return $this->user_credentials;
    }

    public function setUserCredentials(string $user_credentials = null)
    {
        $this->user_credentials = $user_credentials;
    }

    private $api_version;

    public function getApiVersion()
    {
        return $this->api_version;
    }

    public function setApiVersion(string $api_version = null)
    {
        $this->api_version = $api_version;
    }

    private $urls;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl(string $url = null)
    {
        $this->url = $url;
    }

    private $authorization;

    public function getAuthorization()
    {
        return $this->authorization;
    }

    public function setAuthorization(string $authorization = null)
    {
        $this->authorization = $authorization;
    }

    private $x_current_enterprise;

    public function getXCurrentEnterprise()
    {
        return $this->x_current_enterprise;
    }

    public function setXCurrentEnterprise(string $x_current_enterprise = null)
    {
        $this->x_current_enterprise = $x_current_enterprise;
    }

    public function getPath(string $folder = null){
        return  $this->getUrl().''.$this->getApiVersion().''.$folder;
    }

	/**
	* Get Token to allow data transaction
	* @return json 
	**/
	public function logins()
	{
        $url = $this->getPath().'logins';
        $type = 'POST'; 
        return $this->curl($url, $type, [
            'userCredentials' => $this->getUserCredentials() // Token
        ]);
	}

    /**
    * Get a new Token to allow data transaction
    * @return json 
    **/
    public function loginsRenew()
    {
        $url = $this->getPath().'logins/renew';
        $type = 'POST'; 
        return $this->curl($url, $type, [
            'Autorization' => $this->getAuthorization(), //Api Key
            'x-current-enterprise' => $this->getXCurrentEnterprise() //User's enterprise
        ]);
    }


    /**
    * Get Token to allow data transaction
    * @return json 
    **/
    public function loginsCheck()
    {
        $url = $this->getPath().'logins/check';
        $type = 'POST'; 
        return $this->curl($url, $type, [
            'userCredentials' => $this->getUserCredentials() //Token
        ]);
    }

	protected function curl(string $url, $type = null, $data = null)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

		if (is_array($data) && $type == 'POST'){
			$fields = (is_array($data)) ? http_build_query($data) : $data;
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		}

        if (is_array($data) && $type == 'DELETE'){
            $fields = (is_array($data)) ? http_build_query($data) : $data;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        if (is_array($data) && $type == 'PUT'){
            $fields = (is_array($data)) ? http_build_query($data) : $data;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        }

		// Check if any error occurred
		if (curl_errno($ch)){
			$err = curl_error($ch);
			curl_close($ch);
		   	return $err;
		}

		$result = curl_exec($ch);
		curl_close($ch);
 	

 		$r = json_decode($result);
		//Check if user validation is wrong
		return $r; // isset($r->error) ? $r->error : $r;
    }

}