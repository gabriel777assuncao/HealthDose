<?php
?>

@component('mail::message')
    # {{ $title }}

    {{ $intro }}

    @isset($details)
        {{ $details }}
    @endisset

    @isset($actionUrl)
        @component('mail::button', ['url' => $actionUrl])
            {{ $actionText ?? __('notifications.common.action') }}
        @endcomponent
    @endisset

    {{ __('notifications.common.footer_notice') }}

    {{ __('notifications.common.salutation') }}
    {{ config('app.name') }}
@endcomponent
