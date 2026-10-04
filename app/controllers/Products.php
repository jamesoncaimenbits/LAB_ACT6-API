<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('Product_model');
        $this->call->library('session');        
    }

    public function index() {
        $data['products'] = $this->Product_model->get_all();
        $this->call->view('products/index', $data);
    }

    public function create() {
        if ($this->request->method() == 'post') {
            $data = [
                'product_name' => $this->request->post('product_name'),
                'description'  => $this->request->post('description'),
                'price'        => $this->request->post('price'),
                'quantity'     => $this->request->post('quantity'),
            ];
            $this->Product_model->insert($data);
            redirect('products');
        }
        $this->call->view('products/create');
    }

    public function edit($id) {
        if ($this->request->method() == 'post') {
            $data = [
                'product_name' => $this->request->post('product_name'),
                'description'  => $this->request->post('description'),
                'price'        => $this->request->post('price'),
                'quantity'     => $this->request->post('quantity'),
            ];
            $this->Product_model->update($id, $data);
            redirect('products');
        }
        $data['product'] = $this->Product_model->get_by_id($id);
        $this->call->view('products/edit', $data);
    }

    public function delete($id) {
        $this->Product_model->delete($id);
        redirect('products');
    }
}