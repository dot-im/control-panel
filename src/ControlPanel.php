<?php

namespace Dotim\CP;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ControlPanel
{
    /**
     * sidebar menus list.
     *
     * @var array
     */
    private $menu = [];

    /**
     * @var null
     */
    private $currentCategory = null;

    /**
     * control panel config.
     *
     * @var array
     */
    private $config = [];

    /**
     * ControlPanel constructor.
     *
     * @param array $config
     * @return void
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * Get all registered menus.
     *
     * @return array
     */
    public function menus()
    {
        return $this->menu;
    }

    /**
     * Add new menu entry.
     *
     * @param  string $category
     * @return ControlPanel
     */
    public function addCategory($category)
    {
        $this->currentCategory = $category;

        if (! isset($this->menu[$category])) {
            $this->menu[$category] = $category;
        }

        return $this;
    }

    /**
     * Add new items entry.
     *
     * @param string|array $category
     * @param string $itemTitle
     * @param string $itemUrl
     * @return ControlPanel
     */
    public function addItem($category, $itemTitle = null, $itemUrl = null)
    {
        if ($this->currentCategory && is_array($category)) {
            $itemTitle = $category['title'];
            $itemUrl = $category['url'] ?? null;
            $category = $this->currentCategory;
        }

        if (! $itemUrl) {
            $itemUrl = "{$this->config['url']}/".Str::slug(mb_strtolower($itemTitle));
        }

        $itemUrl = "{$this->config['url']}/".ltrim($itemUrl, '/');

        if (isset($this->menu[$category]) && is_array($this->menu[$category])) {
            $this->menu[$category][] = ['title' => $itemTitle, 'url' => $itemUrl];
        } else {
            $this->menu[$category] = [
                ['title' => $itemTitle, 'url' => $itemUrl],
            ];
        }

        return $this;
    }

    /**
     * response to ajax.
     *
     * @param  string $type
     * @param  string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(string $type, string $message)
    {
        return response()->json(['type' => $type, 'message' => $message]);
    }

    /**
     * return success response.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($message)
    {
        return $this->response('success', $message);
    }

    /**
     * return success fails.
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function failsResponse($message)
    {
        return $this->response('fails', $message);
    }

    /**
     * return Validation fails errors.
     *
     * @param  array $data
     * @param  array $rules
     * @param  array $messages
     * @param  array $customAttributes
     *
     * @throws HttpResponseException
     */
    public function validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = Validator::make($data, $rules, $messages = [], $customAttributes = []);

        if ($validator->fails()) {
            $validator->errors()->add('validate_fails', true);

            throw new HttpResponseException(response()->json($validator->errors()));
        }
    }

    /**
     * get form support scripts.
     *
     * @return string
     */
    public function formScripts()
    {
        if (file_exists(public_path('assets/control-panel/js/forum-support.js'))) {
            return '<script src="'.asset('assets/control-panel/js/forum-support.js').'"></script>';
        } else {
            return '<script>'.file_get_contents(base_path('vendor/dot-im/control-panel/src/Dist/js/forum-support.js')).'</script>';
        }
    }
}
