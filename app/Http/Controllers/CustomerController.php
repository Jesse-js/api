<?php 

require_once __DIR__ . '/../../Models/Customer.php';
require_once __DIR__ . '/../../../Facades/Response.php';
require_once __DIR__ . '/../Requests/CustomerRequest.php';
class CustomerController
{
    public function index(array $request)
    {
        $result = Customer::all();
        return Response::json(200, 'Customers list', $result);
    }

    public function store(array $request)
    {
        $result = CustomerRequest::validate($request);
        
        if (!$result['isValid']) {
            return Response::json(406, 'Bad Request', $result['errors']);
        }
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