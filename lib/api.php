<?php

class Api {

    public array $peerList = array();
    public ApiRequest $request;
    public ApiRoute $route;
    public ApiResponse $response;

    public function __construct(){

        $data = file_get_contents('php://input');
        $data = json_decode($data);

        if($data === false) exit('bad request');

        $this->request = new ApiRequest($data->request);
        $this->route = new ApiRoute($data->route);
        $this->response = new ApiResponse($this->route->response);
    }
}