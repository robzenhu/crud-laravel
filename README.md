# Projeto CRUD de Usuários

Este projeto é uma aplicação de CRUD (Create, Read, Update, Delete) para gerenciar usuários. O sistema permite o cadastro, edição, visualização e exclusão de usuários, além de validar CPF e email e preencher dados automaticamente a partir do CEP usando a API Via CEP.

## Tecnologias Utilizadas

- **PHP** com o framework **Laravel**
- **Banco de Dados**: MySQL
- **HTML, CSS, JavaScript**
- **Composer** para gerenciamento de dependências

## Funcionalidades

- **Cadastro de Usuário**: Nome, CPF, Data de Nascimento, Email, Telefone, CEP, Estado, Cidade, Bairro, Endereço, Status (Ativo/Inativo).
- **Validação**: CPF e email válidos.
- **Preenchimento Automático**: A partir do CEP, a API Via CEP preenche os campos de endereço (Estado, Cidade, Bairro, Endereço).
- **Filtros**: Pesquisa de usuários por nome e filtro por status (Ativo/Inativo).
- **Ações**:
  - **Cadastrar** novo usuário
  - **Editar** informações do usuário
  - **Excluir** usuário (inativando-o, mas mantendo no banco de dados)
  - **Exportar dados** em PDF, XLS ou CSV.

## Requisitos de Instalação

### 1. Clonar o Repositório

```bash
git clone https://github.com/robzenhu/crud-laravel.git
cd crud-laravel
