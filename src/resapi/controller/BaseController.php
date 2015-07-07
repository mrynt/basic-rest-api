<?php
 /*******************************************************
 * Copyright (C) 2015 Muhammad Juan Akbar - All Rights Reserved
 * Written by Muhammad Juan Akbar <mail@mjuanakbar.info>, 07 2015
 *
 * BaseController.php can not be copied and/or distributed without the express
 * permission of author.
 *******************************************************/

namespace resapi\controller;


use resapi\Setup;

class BaseController {

    /**
     * @var \Slim\Http\Request
     */
    protected $request;

    /**
     * @var \Slim\Http\Response
     */
    protected $response;

    /**
     * @var Setup
     */
    protected $app;

    /**
     * @var array
     */
    protected $requestBodyArr;

    /**
     * constructor
     * @param Setup $app
     */
    public function __construct(Setup $app){
        $this->app = $app;
        $this->request = $app->request;
        $this->response = $app->response;
        $this->requestBodyArr = json_decode($app->request()->getBody(), true);
    }

    /**
     * convert array to json and parsing to body
     * @param $message
     * @param int $statusCode
     */
    protected function writeToJSON($message, $statusCode = 200){
        $this->response->status($statusCode);
        $this->response['Content-Type'] = 'application/json';
        $this->reponse->body(json_encode($message));
    }

    /**
     * parsing error exception
     * @param array $message
     * @param int $statusCode
     */
    protected function writeException($message = ['errmsg' => 'service unavailable'], $statusCode = 503){
        $this->writeToJSON($message, $statusCode);
    }
}