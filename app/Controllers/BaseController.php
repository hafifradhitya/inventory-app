<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use eftec\bladeone\BladeOne;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url'];
	
	protected $parser = null;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        
        $views = APPPATH.'Views';
        $cache = WRITEPATH.'cache'.DIRECTORY_SEPARATOR.'views';
        if(ENVIRONMENT==='production'){
            $this->parser = new BladeOne($views,$cache,BladeOne::MODE_AUTO);
        }else{
            $this->parser = new BladeOne($views,$cache,BladeOne::MODE_DEBUG);
        }
        
        $this->parser->pipeEnable = true;
        $this->parser->setBaseUrl(site_url());
    }
    
    protected function view($view,$data = []){
        try{
            return $this->parser->run($view,$data);
        } catch (Exception $ex) {
            header_remove();
            http_response_code(500);
            header('HTTP\1.1 500 Internal Server Error');
            echo PHP_EOL;
            echo $ex->getMessage();
            exit();
        }
    }
}
