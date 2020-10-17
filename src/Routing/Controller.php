<?php

namespace Dotim\CP\Routing;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * control panel instance.
     *
     * @var null|\Dotim\CP\ControlPanel
     */
    private $controlPanel = null;

    /**
     * get control panel instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function controlPanel()
    {
        if (! $this->controlPanel) {
            $this->controlPanel = app('control-panel');
        }

        return $this->controlPanel;
    }

    /**
     * return Validation fails errors.
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $this->controlPanel()->validate($data, $rules, $messages, $customAttributes);
    }

    /**
     * response to ajax.
     *
     * @param  string  $type
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($type, $message)
    {
        return $this->controlPanel()->response($type, $message);
    }

    /**
     * return success response.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($message)
    {
        return $this->controlPanel()->successResponse($message);
    }

    /**
     * return success fails.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failsResponse($message)
    {
        return $this->controlPanel()->failsResponse($message);
    }
}
