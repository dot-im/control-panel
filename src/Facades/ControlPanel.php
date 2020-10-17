<?php

namespace Dotim\CP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array menus()
 * @method static \Dotim\CP\ControlPanel addCategory($menuTitle)
 * @method static \Dotim\CP\ControlPanel addItem($category, $itemTitle = null, $itemUrl = null)
 * @method static \Dotim\CP\ControlPanel formScripts()
 * @method static \Illuminate\Http\JsonResponse response($success, $message)
 * @method static \Illuminate\Http\JsonResponse successResponse($message)
 * @method static \Illuminate\Http\JsonResponse failsResponse($message)
 * @method static \Illuminate\Http\JsonResponse validation(array $data, array $rules, array $messages = [], array $customAttributes = [])
 */
class ControlPanel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'control-panel';
    }
}
