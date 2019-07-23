@component('mail::message')
# Introduction

## Pozdrav {{ $user->name }}, dobro došli na naš blog!

@component('mail::button', ['url' => 'https://www.index.hr/'])
Započnite sa čitanjem
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
