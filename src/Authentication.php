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

    protected function getHeader(){

        $header = [];
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization:'.$this->getAuthorization();
        
        return $header;
    }

    /**
    *@param $url string - the complete path of the request 
    *@param $type string - Type of request ('POST, GET, PUT, DELETE')
    *@param $body array - information on class to Edit or Create
    *@return Array
    **/
    protected function curlRequest(string $url, $type = null, $body = null){

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeader());

        switch ($type) {
            case 'POST':
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $fields = (is_array($body)) ? http_build_query($body) : $body;
                curl_setopt($ch, CURLOPT_POSTFIELDS, [$fields]);
                curl_setopt($ch, CURLOPT_POST, 1);
            break;
            case 'PUT':
                $param = str_replace('s/', '', static::ENTITY);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $fields = (is_array($body)) ? http_build_query($body) : $body;
                curl_setopt($ch, CURLOPT_POSTFIELDS, [$fields]);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $fields = (is_array($body)) ? http_build_query($body) : $body;
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            break;
            default:
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            break;
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

        return $r;
    }


}