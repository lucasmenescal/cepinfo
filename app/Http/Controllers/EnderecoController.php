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
    public function salvarEnderecoViaApi($cep)
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
     * Salva no Banco um Endereço
     */
    public function save(Request $request)
    {
        $endereco = Endereco::create([
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'localidade' => $request->cidade,
            'uf' => $request->estado,
            'ibge' => $request->ibge,
            'gia' => $request->gia,
            'ddd' => $request->ddd,
            'siafi' => $request->siafi,
        ]);

        return response()->json($endereco, 201);
    }
}
