<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Helpers available to all controllers and views.
     */
    protected $helpers = [
        'form',
        'url',
    ];

    /**
     * Session service.
     */
    protected $session;

    /**
     * Initialize the controller.
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Load the session service.
        $this->session = service('session');
    }
}