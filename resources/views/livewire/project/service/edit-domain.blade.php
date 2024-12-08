<form wire:submit.prevent='submit' class="flex flex-col w-full gap-2">
    <div class="pb-2">Note: If a service has a defined port, do not delete it. <br>If you want to use your custom
        domain, you can add it with a port.</div>
    <x-forms.input placeholder="https://app-hostly.khulnasoft.com" label="Domains" id="application.fqdn"
        helper="You can specify one domain with path or more with comma. You can specify a port to bind the domain to.<br><br><span class='text-helper'>Example</span><br>- http://app-hostly.khulnasoft.com,https://cloud.hostly.khulnasoft.com/dashboard<br>- http://app-hostly.khulnasoft.com/api/v3<br>- http://app-hostly.khulnasoft.com:3000 -> app-hostly.khulnasoft.com will point to port 3000 inside the container. "></x-forms.input>
    <x-forms.button type="submit">Save</x-forms.button>
</form>
