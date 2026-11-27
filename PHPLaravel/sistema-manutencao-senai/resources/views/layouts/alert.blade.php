@props(['tipo' => 'info'])

@php
    $classe = match($tipo) {
        'danger'  => 'alert-danger',
        'warning' => 'alert-warning',
        'success' => 'alert-success',
        default   => 'alert-info',
    };
@endphp

<style>
    .alert-component {
        padding: 12px 16px;
        border-left: 4px solid;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 0.88rem;
    }

    .alert-component.alert-danger {
        border-left-color: #dc2626;
        background: #7f1d1d;
        color: #fecaca;
    }

    .alert-component.alert-warning {
        border-left-color: #d97706;
        background: #78350f;
        color: #fef3c7;
    }

    .alert-component.alert-success {
        border-left-color: #16a34a;
        background: #14532d;
        color: #bbf7d0;
    }

    .alert-component.alert-info {
        border-left-color: #0284c7;
        background: #0c4a6e;
        color: #bae6fd;
    }
</style>

<div class="alert-component {{ $classe }}">
    {{ $slot }}
</div>
