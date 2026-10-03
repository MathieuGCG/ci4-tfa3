<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data['customers'] = $this->customerModel->findAll();
        return view('customers/index', $data);
    }

    public function new()
    {
        helper(['form']);
        return view('customers/new');
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'full_name' => 'required|min_length[3]',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return view('customers/new', ['validation' => $this->validator]);
        }

        $this->customerModel->save([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/customers')->with('message', 'Customer created successfully.');
    }

    public function edit($id)
    {
        helper(['form']);
        $customer = $this->customerModel->find($id);

        if (!$customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Customer not found.");
        }

        return view('customers/edit', ['customer' => $customer]);
    }

    public function update($id)
    {
        helper(['form']);

        $rules = [
            'full_name' => 'required|min_length[3]',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            $customer = $this->customerModel->find($id);
            return view('customers/edit', [
                'validation' => $this->validator,
                'customer'   => $customer,
            ]);
        }

        $this->customerModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers')->with('message', 'Customer updated successfully.');
    }
}