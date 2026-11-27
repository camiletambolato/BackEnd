@props(['status'])

@php
    $config = match(strtoupper((string)$status)) {
        'OPERANDO', 'CONCLUIDA' => ['fundo' => '#166534', 'texto' => '#bbf7d0', 'label' => $status],
        'EM_ANDAMENTO', 'ALERTA' => ['fundo' => '#854d0e', 'texto' => '#fef08a', 'label' => 'EM ANDAMENTO'],
        'MANUTENCAO', 'PARADO', 'CRITICA' => ['fundo' => '#991b1b', 'texto' => '#fecaca', 'label' => $status],
        default => ['fundo' => '#334155', 'texto' => '#cbd5e1', 'label' => $status],
    };
@endphp

<span @style([
    'background: ' . $config['fundo'] => true,
    'color: ' . $config['texto'] => true,
    'padding: 3px 10px' => true,
    'border-radius: 4px' => true,
    'font-size: 0.75rem' => true,
    'font-weight: bold' => true,
])>
    {{ $config['label'] }}
</span>
