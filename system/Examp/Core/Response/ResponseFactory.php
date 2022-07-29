<?php

namespace Core\Response;

use Core\Controller;
use Core\Request\Request;
use Core\View\ViewRenderer;
/**
 * Description of ResponseFactory
 */
class ResponseFactory {

    private $viewRenderer;

    public function __construct( ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    public function createResponse( Controller $controllerReponse, Request $request, Response $response)
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
            $modelAndViewObj = $controllerReponse->getModelAndView();
            $viewName = $modelAndViewObj->getViewName();

            $viewDataMerge = array_merge(
                $modelAndViewObj->getViewData(),
                [
                    'baseUrl' => $request->getBaseUrl(),
                    'sess' => $session->getAll(),
                    'flash' => $session->flash()->getAll()
                ]
            );

            $response->setBody( $this->viewRenderer->render($viewName, $viewDataMerge) );
            return $response;
        }
    }

}/////end ResponseFactory
