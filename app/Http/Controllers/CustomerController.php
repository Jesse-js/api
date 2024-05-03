<?php 

class CustomerController
{
    public function index(array $request)
    {
        return "Listar Clientes";
    }

    public function store(array $request)
    {
        return "Criar Clientes";
    }

    public function show(array $request)
    {
        return "Visualizar Clientes";
    }

    public function update(array $request)
    {
        return "Editar Clientes";
    }

    public function destroy(array $request)
    {
        return "Excluir Clientes";
    }
}