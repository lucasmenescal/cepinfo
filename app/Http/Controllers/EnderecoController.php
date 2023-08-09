<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use Illuminate\Support\Facades\Http;

class EnderecoController extends Controller
{
    /**
     * Busca na API ViaCepApi um Endereço.
     */
    public function buscar($cep)
    {
        $endereco = Endereco::where('cep', $cep)->first();

        if (!$endereco) {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->ok()) {
                $data = $response->json();
                return response()->json($data);
            }
        }

        return response()->json($endereco);
    }

    /**
     * Lista todos os Endereços salvos no banco de dados.
     */
    public function listarTudo()
    {
        $enderecos = Endereco::all();
        return response()->json($enderecos);
    }

    /**
     * Salva no Banco um Endereço enviado como request
     */
    public function save(Request $request)
    {
        try {
            if ($request) {
                $endereco = Endereco::create([
                    'cep' => $request->cep,
                    'logradouro' => $request->logradouro,
                    'complemento' => $request->complemento,
                    'bairro' => $request->bairro,
                    'localidade' => $request->localidade,
                    'uf' => $request->uf,
                    'ibge' => $request->ibge,
                    'gia' => $request->gia,
                    'ddd' => $request->ddd,
                    'siafi' => $request->siafi
                ]);
            }
            return response()->json($endereco, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao salvar. Endereço ja existe.'], 500);
        }
    }

    /**
     * Deleta um Endereço do banco.
     */
    public function delete($cep)
    {
        $cep = $this->formatarCep($cep);
        $endereco = Endereco::where('cep', $cep)->first();

        if (!$endereco) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $endereco->delete();

        return response()->json(['message' => 'Endereço deletado com sucesso'], 200);
    }

    private function formatarCep($cep)
    {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

    /**
     * Edita um Endereço do banco.
     */
    public function update(Request $request, $cep)
    {
        $cep = $this->formatarCep($cep);
        $endereco = Endereco::where('cep', $cep)->first();

        if (!$endereco) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $endereco->update([
            'logradouro' => $request->input('logradouro', $endereco->logradouro),
            'complemento' => $request->input('complemento', $endereco->complemento),
            'bairro' => $request->input('bairro', $endereco->bairro),
            'localidade' => $request->input('localidade', $endereco->localidade),
            'uf' => $request->input('uf', $endereco->uf),
            'ibge' => $request->input('ibge', $endereco->ibge),
            'gia' => $request->input('gia', $endereco->gia),
            'ddd' => $request->input('ddd', $endereco->ddd),
            'siafi' => $request->input('siafi', $endereco->siafi)
        ]);

        return response()->json(['message' => 'Endereço atualizado com sucesso'], 200);
    }
}
