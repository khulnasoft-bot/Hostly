<x-emails.layout>
A resource ({{ $containerName }}) has been restarted automatically on {{ $serverName }}, because it was stopped unexpectedly.

@if ($containerName === 'hostly-proxy')
Hostly Proxy should run on your server as you have FQDNs set up in one of your resources.

If you don't want to use Hostly Proxy, please remove FQDN from your resources or set Proxy type to Custom(None).
@endif
</x-emails.layout>
