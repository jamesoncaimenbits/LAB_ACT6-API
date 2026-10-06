<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('api');
    }

    private function clean($value)
    {
        return html_entity_decode((string) $value, ENT_QUOTES, 'UTF-8');
    }

    private function validate($in)
    {
        if (empty($in['product_name']) || !isset($in['price']) || !is_numeric($in['price'])
            || !isset($in['quantity']) || !is_numeric($in['quantity'])) {
            $this->api->respond_error('product_name, numeric price and numeric quantity are required', 422);
        }
    }

    public function index()
    {

        $this->api->require_method('GET');
        $this->api->require_jwt();
        $stmt = $this->db->raw('SELECT * FROM products ORDER BY id DESC');
        $this->api->respond($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function store()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();
        $in = $this->api->body();
        $this->validate($in);

        $this->db->raw(
            'INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)',
            [$this->clean($in['product_name']), $this->clean($in['description'] ?? ''), $in['price'], (int) $in['quantity']]
        );
        $this->api->respond(['message' => 'Product created'], 201);
    }

    public function update($id)
    {
        $this->api->require_method('PUT');
        $this->api->require_jwt();
        $in = $this->api->body();
        $this->validate($in);

        $this->db->raw(
            'UPDATE products SET product_name = ?, description = ?, price = ?, quantity = ? WHERE id = ?',
            [$this->clean($in['product_name']), $this->clean($in['description'] ?? ''), $in['price'], (int) $in['quantity'], $id]
        );
        $this->api->respond(['message' => 'Product updated']);
    }

    public function destroy($id)
    {
        $this->api->require_method('DELETE');
        $this->api->require_jwt();
        $this->db->raw('DELETE FROM products WHERE id = ?', [$id]);
        $this->api->respond(['message' => 'Product deleted']);
    }
}