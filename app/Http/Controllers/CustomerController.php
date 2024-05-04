<?php

require_once __DIR__ . '/../../Models/Customer.php';
require_once __DIR__ . '/../../../Facades/Response.php';
require_once __DIR__ . '/../Requests/CustomerRequest.php';
require_once __DIR__ . '/../../Utils/Formatter.php';

class CustomerController
{
    public function index(array $request)
    {
        try {
            $result = Customer::all();

            if (!$result)
                return Response::json(200, 'The customers list is empty', ['data' => []]);

            foreach ($result as $key => $customer) {
                $result[$key]['date_of_birth'] = Formatter::getBrazilianDate(
                    $customer['date_of_birth']
                );
            }

            return Response::json(200, 'Customers list', $result);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
    }

    public function store(array $request)
    {
        try {
            $data = $request['body'];
            $validation = CustomerRequest::validate($data);

            if (!$validation['isValid'])
                return Response::json(406, 'Bad Request', $validation['errors']);

            $data['date_of_birth'] = Formatter::getUniversalDate($data['date_of_birth']);

            $customerId = Customer::create($data);
            return Response::json(201, 'Customer created', ['customer_id' => $customerId]);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
    }

    public function show(int $id, array $request)
    {
        try {
            $result = Customer::find($id);

            if (!$result)
                return Response::json(404, 'Customer not found');

            foreach ($result as $key => $customer) {
                $result[$key]['date_of_birth'] = Formatter::getBrazilianDate(
                    $customer['date_of_birth']
                );
            }

            return Response::json(200, 'Customers list', $result);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
    }

    public function update(int $id, array $request)
    {
        try {
            $data = $request['body'];

            $result = Customer::find($id);
            if (!$result)
                return Response::json(404, 'Customer not found');

            $validation = CustomerRequest::validate($data);

            if (!$validation['isValid'])
                return Response::json(406, 'Bad Request', $validation['errors']);

            $data['date_of_birth'] = Formatter::getUniversalDate($data['date_of_birth']);

            $customerId = Customer::update($id, $data);
            return Response::json(200, 'Customer updated', ['customer_id' => $customerId]);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
    }

    public function destroy(int $id, array $request)
    {
        try {
            $result = Customer::find($id);

            if (!$result)
                return Response::json(404, 'Customer not found');

            $customerId = Customer::delete($id);
            return Response::json(200, 'Customer deleted', ['customer_id' => $customerId]);
        } catch (\Throwable $th) {
            return Response::json(500, 'Internal Server Error', [$th->getMessage()]);
        }
    }
}
