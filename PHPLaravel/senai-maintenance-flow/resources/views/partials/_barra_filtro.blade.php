<div style="background: #0f172a; padding: 12px 18px; border-radius: 6px; border: 1px solid #334155; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
    <span style="font-size: 0.85rem; color: #94a3b8; font-weight: bold;">Filtrar por Status:</span>
    @if ($filtroAtual === '')
        <a href="{{ route('ordens.index') }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #0284c7;">Todas</a>
    @else
        <a href="{{ route('ordens.index') }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #334155;">Todas</a>
    @endif
    @if ($filtroAtual === 'aberta')
        <a href="{{ route('ordens.index', ['status' => 'aberta']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #0284c7;">Abertas</a>
    @else
        <a href="{{ route('ordens.index', ['status' => 'aberta']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #334155;">Abertas</a>
    @endif
    @if ($filtroAtual === 'em_andamento')
        <a href="{{ route('ordens.index', ['status' => 'em_andamento']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #0284c7;">Em Andamento</a>
    @else
        <a href="{{ route('ordens.index', ['status' => 'em_andamento']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #334155;">Em Andamento</a>
    @endif
    @if ($filtroAtual === 'concluida')
        <a href="{{ route('ordens.index', ['status' => 'concluida']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #0284c7;">Concluídas</a>
    @else
        <a href="{{ route('ordens.index', ['status' => 'concluida']) }}" class="btn" style="padding: 4px 10px; font-size: 0.78rem; background: #334155;">Concluídas</a>
    @endif
</div>
