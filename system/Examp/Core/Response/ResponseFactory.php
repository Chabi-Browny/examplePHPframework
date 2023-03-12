<?php

namespace Examp\Core\Response;

use Examp\Core\Controller;
use Examp\Core\Request\Request;
use Examp\Core\View\ViewRenderer;
use Examp\Core\Response\Response;

/**
 * Description of ResponseFactory
 */
class ResponseFactory
{
    /**
     * @desc - ViewRenderer object
     * @var ViewRenderer
     */
    private $viewRenderer;

    /**
     * @param ViewRenderer $viewRenderer
     */
    public function __construct( ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    /**
     * @desc - Creates a proper response
     * @param Controller $controllerReponse
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function createResponse( Controller $controllerReponse, Request $request, Response $response): Response
    {
        $redirectTarget = $controllerReponse->getRedriectTarget();
        $session = $request->getSession();

        $dataToFlash = $controllerReponse->getFlashData();

        if ( is_string($redirectTarget) )
        {
            if (!empty($dataToFlash) && is_array($dataToFlash))
            {
                foreach ($dataToFlash as $flashKey => $flashData)
                {
                    $session->flash()->add($flashKey, $flashData);
                }
            }
            return $response->redirect($redirectTarget);
        }
        else
        {
            $modelAndViewObj = $controllerReponse->getView();
            
            $response->setBody( 
                $this->viewRenderer->render(
                    $modelAndViewObj->getViewName(), 
                    array_merge(
                        $modelAndViewObj->getViewData(),
                        [
                            'baseUrl' => $request->getBaseUrl(),
                            'sess' => $session->getAll(),
                            'flash' => $session->flash()->getAll()
                        ]
                    )
                ) 
            );
            
            return $response;
        }
    }

} // end ResponseFactory
