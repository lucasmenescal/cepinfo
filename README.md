# CepInfo API

Bem-vindo ao repositório da CepInfo API! Esta é uma API desenvolvida em Laravel 9 que oferece endpoints para manipulação de endereços em um banco de dados PostgreSQL. Continue lendo para entender como usar e contribuir para esta API.

## Visão Geral

A CepInfo API é uma aplicação Laravel construída para gerenciar informações de endereços em um banco de dados PostgreSQL. Ela oferece endpoints convenientes para criar, editar, deletar e buscar endereços de maneira eficiente.

## Recursos

- **CRUD de Endereços:** A API oferece os seguintes endpoints para manipular endereços:
  - `GET /enderecos/listarTudo`: Retorna a lista de todos os endereços.
  - `GET /enderecos/buscar/{cep}`: Retorna um endereço específico com base no CEP.
  - `POST /enderecos/save`: Cria um novo endereço.
  - `PUT /enderecos/update`: Edita um endereço existente.
  - `DELETE /enderecos/delete/{cep}`: Deleta um endereço existente com base no CEP.

- **Banco de Dados PostgreSQL:** A API utiliza um banco de dados PostgreSQL para armazenar os dados de endereço.

## Instruções de Uso

Para executar a CepInfo API em sua máquina local, siga estas etapas simples:

1. **Clone o repositório:** Comece clonando este repositório em sua máquina usando o seguinte comando:
```git clone https://github.com/lucasmenescal/cepinfo-api.git```


2. **Navegue até o diretório:** Entre no diretório do projeto usando o comando:
```cd cepinfo-api```

3. **Instale as dependências:** Use o Composer para instalar as dependências necessárias:
```composer install```

4. **Configuração do Banco de Dados:** Configure o arquivo `.env` com as informações do seu banco de dados PostgreSQL.

5. **Execute as migrações:** Execute as migrações para criar a estrutura do banco de dados:
```php artisan migrate```

6. **Inicie o servidor:** Inicie o servidor da API com o comando:
```php artisan serve```

7. **Acesse a API:** Agora você pode acessar a API em `http://localhost:8000`.

## Contato

- [LinkedIn](https://www.linkedin.com/in/lucasmenescalpontes/)
- Email: lucasmenescalpontes@gmail.com

