<?php

require_once __DIR__ . '/../../Models/Customer.php';
require_once __DIR__ . '/../../../Facades/Response.php';
require_once __DIR__ . '/../Requests/CustomerRequest.php';
class CustomerController
{
    public function index(array $request)
    {
        try {
            $result = Customer::all();
            return Response::json(200, 'Customers list', $result);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
    }

    public function store(array $request)
    {
        try {
            $result = CustomerRequest::validate($request);

            if (!$result['isValid'])
                return Response::json(406, 'Bad Request', $result['errors']);

            $request['body']['date_of_birth'] = date('Y-m-d', strtotime($request['body']['date_of_birth']));

            $customerId = Customer::create((array) $request['body']);
            return Response::json(201, 'Customer created', ['customer_id' => $customerId]);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
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
