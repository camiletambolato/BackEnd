<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\OrdemServico;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrdemServicoController extends Controller
{
    /**
     * Lista todas as ordens de manutencao com filtros de status.
     */
    public function index(Request $request): View {
        $filtroStatus = (string)$request->query('status', '');
        $todas = OrdemServico::todas();

        $ordens = $filtroStatus !== '' 
            ? array_filter($todas, fn($o) => $o->status === Str::upper($filtroStatus))
            : $todas;

        return view('ordens.index', [
            'ordens'       => $ordens,
            'filtroAtivo'  => $filtroStatus,
            'titulo'       => 'Gestão de Ordens de Serviço'
        ]);
    }

    /**
     * Exibe o formulario para abertura de nova ordem de servico.
     */
    public function create(): View {
        return view('ordens.create', [
            'equipamentos' => Equipamento::todos(),
            'titulo'       => 'Abertura de Chamado de Manutenção'
        ]);
    }

    /**
     * Valida os dados da requisicao e simula a persistencia da O.S.
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'titulo'         => 'required|min:5',
            'equipamento_id' => 'required|integer',
            'prioridade'     => 'required|in:BAIXA,MEDIA,ALTA,CRITICA'
        ]);

        return redirect()->route('ordens.index')
            ->with('mensagem_sucesso', 'Ordem de serviço registrada com sucesso!');
    }

    /**
     * Exibe a ficha tecnica completa da ordem de servico.
     */
    public function show(string $codigo): View {
        $ordem = OrdemServico::buscarPorCodigo($codigo);
        abort_if(!$ordem, 404, 'Ordem de serviço não localizada.');

        $equipamento = Equipamento::buscarPorId($ordem->equipamentoId);

        return view('ordens.show', [
            'ordem'       => $ordem,
            'equipamento' => $equipamento,
            'titulo'      => "Ficha da Ordem {$ordem->codigo}"
        ]);
    }
}
