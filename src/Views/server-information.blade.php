<style>
    .server-information .card-body{padding: 0;}
    .server-information .card-body .table{word-break: break-all;}
</style>

<x-control-panel-card :header="__('Server Information')" class="server-information">
    <table class="table m-0">
        <tbody>
            <tr>
                <td class="border-top-0 w-25 font-weight-bold bg-light">Server Os Type :</td>
                <td class="border-top-0 w-75">{{ php_uname() }}</td>
            </tr>
            <tr>
                <td class="w-25 font-weight-bold bg-light">Web Server :</td>
                <td class="w-75">{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
            </tr>
            <tr>
                <td class="w-25 font-weight-bold bg-light">PHP :</td>
                <td class="w-75">{{ phpversion() }}</td>
            </tr>
            <tr>
                <td class="w-25 font-weight-bold bg-light">PHP Max Post Size :</td>
                <td class="w-75">{{ ini_get('post_max_size') }}</td>
            </tr>
            <tr>
                <td class="w-25 font-weight-bold bg-light">PHP Maximum Upload Size :</td>
                <td class="w-75">{{ ini_get('max_file_uploads') }}</td>
            </tr>
            <tr>
                <td class="w-25 font-weight-bold bg-light">PHP Memory Limit :</td>
                <td class="w-75">{{ ini_get('memory_limit') }}</td>
            </tr>
            <tr>
                <td class="w-25 font-weight-bold bg-light">Database Type :</td>
                <td class="w-75">{{ strtoupper(config('database.default')) }}</td>
            </tr>

            @foreach($_SERVER as $key => $value)
                <tr>
                    <td class="w-25 font-weight-bold bg-light">{{ $key }} :</td>
                    <td class="w-75">{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-control-panel-card>
