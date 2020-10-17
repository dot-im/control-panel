<form {{ $attributes->merge(['method' => $method, 'action' => $action, 'enctype' => "multipart/form-data", 'id' => $id]) }} data-ajax-submit>
    @method($method) @csrf

    {{ $slot }}
</form>
