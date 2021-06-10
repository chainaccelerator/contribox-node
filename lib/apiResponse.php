<?php

class ApiResponse extends ApiRequest {

    public bool $state = false;
    public ApiResponseSuccess $success;
    public ApiResponseError $error;

    public function __constuct() {
        parent::__constuct();

        $this->success = new ApiResponseSuccess();
        $this->error = new ApiResponseError();
    }
}