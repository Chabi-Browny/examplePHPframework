<?php

namespace Core\UI;

/**
 * Description of FormResponseFromatter
 */
class FormResponseFormater {

    const MESSAGE_TYPE = [
        'info' => 'msg-info',
        'warn' => 'msg-warn',
        'error'=> 'msg-error'
    ];

    protected $responseTextStock = [];
    protected $messageStock = [];
    protected $messageType = null;
    protected $responseMessageBox = '<div class="%s">%s</div>';

    public function __construct( $responseTextStock, string $msgType = null)
    {
        $this->responseTextStock = $responseTextStock;
        $this->messageType = $msgType ?? 'info';
    }

    /**/
    public function getFormattedMessage()
    {
        $warpperContainer = '<div class="msg-wrapper">';

        $warpperContainer .= $this->formatMessage();

        $warpperContainer .= '</div>';

        return $warpperContainer;
    }

    /**/
    protected function storeMessageToFormat()
    {
        $messageStock = [];
        if (!empty($this->responseTextStock))
        {
            if ( !is_array($this->responseTextStock))
            {
                $messageStock[$this->messageType] = $this->responseTextStock;
            }
            else
            {
                $messageStock = $this->responseTextStock;
            }
        }
        return $messageStock;
    }

    /**/
    protected function formatMessage()
    {
        $formatedMessages = '';

        $messages = $this->storeMessageToFormat();

        foreach ($messages as $msgType => $respTexts)
        {
            if (is_array($respTexts))
            {
                foreach ($respTexts as $respText)
                {
                    $formatedMessages .= sprintf($this->responseMessageBox, self::MESSAGE_TYPE[$msgType], $respText);
                }
            }
            else
            {
                $formatedMessages .= sprintf($this->responseMessageBox, self::MESSAGE_TYPE[$msgType], $respTexts);
            }
        }

        return $formatedMessages;
    }

}
