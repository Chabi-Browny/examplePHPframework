<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Core;

use Core\View\ModelAndView;
use Core\UI\FormResponseFormater;

class Controller {

    protected $modelAndView;
    protected $redriectTarget;
    protected $flashData = [];

    public function __construct()
    {
        $this->modelAndView = new ModelAndView();
    }

    public function setView(string $viewName, array $viewData = [])
    {
        $this->modelAndView->setViewName($viewName);
        $this->modelAndView->setViewData($viewData);
        return $this;
    }

    public function setRedirect(string $redirectTarget): self
    {
        $this->redriectTarget = $redirectTarget;
        return $this;
    }

    public function getRedriectTarget(): ?string
    {
        return $this->redriectTarget;
    }

    public function setFlashData(string $flashkey, $flashData, $msgType = null): void
    {
        $msgFormater = new FormResponseFormater($flashData, $msgType);
        $this->flashData[$flashkey] = $msgFormater->getFormattedMessage();
    }

    public function getFlashData()
    {
        return $this->flashData;
    }

    public function getModelAndView() : ModelAndView
    {
        return $this->modelAndView;
    }

}