<?php

defined('BASEPATH') or exit('No direct script access alowed');

class Crud extends CI_Controller
{

    protected $tableName = REGISTRATION; // Set Table Name

    // Constructor
    public function __construct()
    {
        // CI Default Constructor
        parent::__construct();

        // Load DataBase Library
        $this->load->database();
    }


    // Function For LoginPage Display
    public function index()
    {
        // Load index.php(Login) Page
        $this->load->view('index');

        // Check Add-Data Button Submit
        if ($this->input->post('login')) {
            $this->crud_model->authanticate($this->tableName);
        }
    }

    // View Data
    public function view()
    {
        // Call Model View Record and Pass Table Name
        $records['data'] = $this->crud_model->viewRecords($this->tableName);

        // Load view.php Page
        $this->load->view('view', $records);

        // Check AddData Button Is Click
        if ($this->input->post('addData')) {
            redirect('Project/day8/crud/insert');
        }

        // Check LogOut Button Is Click
        if ($this->input->post('logout')) {
            $this->session->unset_userdata('userEmail');
            redirect('Project/day8/crud');
        }
    }

    // Insert and Update Record
    public function insert()
    {
        // Load Insert.php Page
        $this->load->view('insert');

        $id = $this->input->get('id'); // Get Id From The URL 

        if ($this->input->post('insert')) { // Check Insert Button Is Click

            // Call Helper Function For Upload Image
            $imgName = image_Upload();

            if ($imgName) { // Image Name Is Set 

                // Convert Date From dd/mm/yyyy To yyyy/mm/dd
                $birthDate = implode("/", array_reverse(explode("/", $this->input->post('birthdate'))));

                // Fetch Values Form The Form
                $data['name'] = $this->input->post('name') == NULL ? "" : $this->input->post('name');
                $data['contact'] = $this->input->post('mno') == NULL ? "" : implode(":", $this->input->post('mno'));
                $data['email'] = $this->input->post('email') == NULL ? "" : $this->input->post('email');
                $data['password'] = $this->input->post('password') == NULL ? "" : $this->input->post('password');
                $data['address'] = $this->input->post('address') == NULL ? "" : $this->input->post('address');
                $data['user_type'] = $this->input->post('usertype') == NULL ? "" : $this->input->post('usertype');
                $data['is_active'] = $this->input->post('isactive') == NULL ? "inactive" : "active";
                $data['hobby'] =  $this->input->post('hobby') == NULL ? "" : implode(",", $this->input->post('hobby'));
                $data['date_of_birth'] = $birthDate == NULL ? "" : $birthDate;
                $data['profile'] = $imgName == NULL ? "" : $imgName;

                // Call Model Save Record and Pass Table Name and All The Data
                $this->crud_model->saveRecord($this->tableName, $data);
            }
        }

        if ($this->input->post('update')) { // Check Update Button IS Click

            // Call Helper Function For Upload Image
            $imgName = image_Upload();

            if ($imgName) {
                // Convert Date From dd/mm/yyyy To yyyy/mm/dd
                $birthDate = implode("/", array_reverse(explode("/", $this->input->post('birthdate'))));

                // Fetch Values Form The Form
                $data['name'] = $this->input->post('name') == NULL ? "" : $this->input->post('name');
                $data['contact'] = $this->input->post('mno') == NULL ? "" : implode(":", $this->input->post('mno'));
                $data['email'] = $this->input->post('email') == NULL ? "" : $this->input->post('email');
                $data['password'] = $this->input->post('password') == NULL ? "" : $this->input->post('password');
                $data['address'] = $this->input->post('address') == NULL ? "" : $this->input->post('address');
                $data['user_type'] = $this->input->post('usertype') == NULL ? "" : $this->input->post('usertype');
                $data['is_active'] = $this->input->post('isactive') == NULL ? "inactive" : "active";
                $data['hobby'] =  $this->input->post('hobby') == NULL ? "" : implode(",", $this->input->post('hobby'));
                $data['date_of_birth'] = $birthDate == NULL ? "" : $birthDate;
                $data['profile'] = $imgName == NULL ? "" : $imgName;

                // Call Model Update Record and Pass Table Name ,All The Data and Id
                $this->crud_model->updateRecord($this->tableName, $data, $id);
            }
        }
    }

    // Delete Record
    public function delete()
    {
        $id = $this->input->get('id'); // Get Id From The URL

        // Call Model Delete Record and Pass Id
        $this->crud_model->deleteRecord($this->tableName, $id);
    }
}
