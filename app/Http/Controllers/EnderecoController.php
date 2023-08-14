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
    public function buscar(Request $request, $cep)
    {
        $endereco = Endereco::where('cep', $cep)->first();

        if (!$endereco) {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->ok()) {
                $data = $response->json();

                $endereco = new Endereco();
                $endereco->cep = $cep;
                $endereco->logradouro = $data['logradouro'];
                $endereco->complemento = $data['complemento'];
                $endereco->bairro = $data['bairro'];
                $endereco->localidade = $data['localidade'];
                $endereco->uf = $data['uf'];
                $endereco->ibge = $data['ibge'];
                $endereco->gia = $data['gia'];
                $endereco->ddd = $data['ddd'];
                $endereco->siafi = $data['siafi'];
                $endereco->save();

                return response()->json($data);
            }
        }

        return response()->json($endereco);
    }


    /**
     * Lista todos os Endereços salvos no banco de dados.
     */
    public function listarTudo(Request $request)
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
            $endereco = new Endereco();

            $existingEndereco = Endereco::where('cep', $request->input('cep'))->first();
            if ($existingEndereco) {
                return response()->json(['message' => 'Endereço com o mesmo CEP já existe.', 'code' => '400'], 400);
            }

            $endereco->cep = $request->input('cep');
            $endereco->logradouro = $request->input('logradouro');
            $endereco->complemento = $request->input('complemento');
            $endereco->bairro = $request->input('bairro');
            $endereco->localidade = $request->input('localidade');
            $endereco->uf = $request->input('uf');
            $endereco->ibge = $request->input('ibge');
            $endereco->gia = $request->input('gia');
            $endereco->ddd = $request->input('ddd');
            $endereco->siafi = $request->input('siafi');
            $endereco->save();

            return response()->json($endereco, 201, ['code' => '201'] );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao salvar.', 'code' => '500'], 500);
        }
    }

    /**
     * Deleta um Endereço do banco.
     */
    public function delete(Request $request, $cep)
    {
        // $cep = $this->formatarCep($cep);
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
    public function update(Request $request)
{
    $cep = $request->input('cep');
    // $cep = $this->formatarCep($cep);
    $endereco = Endereco::where('cep', $cep)->first();

    if (!$endereco) {
        return response()->json(['message' => 'Endereço não encontrado'], 404);
    }

    $endereco->update([
        // 'cep' => $endereco->$cep,
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
