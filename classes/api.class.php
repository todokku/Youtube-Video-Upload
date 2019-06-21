<?php

class YoutubeApi
{
    public $client;
    private $service;

    public function __construct()
    {
        // google'ın çatı clientı
        $this->client = new Google_Client();
        $this->client->setAuthConfig('credentials.json');
        $this->client->addScope('https://www.googleapis.com/auth/youtube.force-ssl');
        $this->client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
        $this->client->setRedirectUri('http://' . $_SERVER['HTTP_HOST']);

        // ssl isteme hatası
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $this->client->setHttpClient($guzzleClient);
    }

    public function redirectAfterLogin($code)
    {
        $this->client->authenticate($code);
        $_SESSION['access_token'] = $this->client->getAccessToken();

        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'];
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }

    public function auth()
    {
        $this->client->setAccessToken($_SESSION['access_token']);
    }

    public function isUserLogged()
    {
        if ($this->client->getAccessToken()) {
            return true;
        }
        return false;
    }

    public function setService()
    {
        $this->service = new Google_Service_YouTube($this->client);
    }

    public function videosInsert($media_file, $properties, $part, $params)
    {
        $params = array_filter($params);
        $propertyObject = $this->createResource($properties);

        $resource = new Google_Service_YouTube_Video($propertyObject);

        $this->client->setDefer(true);
        $request = $this->service->videos->insert($part, $resource, $params);
        $this->client->setDefer(false);

        $response = $this->uploadMedia($request, $media_file, 'video/*');
        print_r($response);
        return $response;
    }

    // for video insert 
    private function createResource($properties)
    {
        $resource = array();
        foreach ($properties as $prop => $value) {
            if ($value) {
                $this->addPropertyToResource($resource, $prop, $value);
            }
        }
        return $resource;
    }
    // for video insert 
    private function addPropertyToResource(&$ref, $property, $value)
    {
        $keys = explode(".", $property);
        $is_array = false;
        foreach ($keys as $key) {
            if (substr($key, -2) == "[]") {
                $key = substr($key, 0, -2);
                $is_array = true;
            }
            $ref = &$ref[$key];
        }
        if ($is_array && $value) {
            $ref = $value;
            $ref = explode(",", $value);
        } elseif ($is_array) {
            $ref = array();
        } else {
            $ref = $value;
        }
    }
    // for video insert     
    private function uploadMedia($request, $filePath, $mimeType)
    {
        $chunkSizeBytes = 1 * 1024 * 1024;

        $media = new Google_Http_MediaFileUpload(
            $this->client,
            $request,
            $mimeType,
            null,
            true,
            $chunkSizeBytes
        );

        $media->setFileSize(filesize($filePath));

        $status = false;
        $handle = fopen($filePath, "rb");


        while (!$status && !feof($handle)) {
            $chunk = fread($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
            echo $chunkSizeBytes;
        }
        fclose($handle);
        return $status;
    }

    public function login()
    {
        $auth_url = $this->client->createAuthUrl();
        header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    }
    public function logout()
    {
        session_destroy();
    }
}
