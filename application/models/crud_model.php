<?php

class Crud_model extends CI_Model
{

    // Chek For Valid User
    public function authanticate($tableName)
    {
        // Get Data From The Login Form
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Query for Select Particular Record With Where Clause
        $this->db->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get($tableName);
        $result = $query->num_rows();

        if ($result > 0) { // If Result Is Greater Than 0
            // Set The Seesion Value 
            $this->session->set_userdata('userEmail', $email);
            $this->session->set_userdata('successMsg', 'Login Successfilly...');

            redirect('Project/day8/crud/view'); // Redirect On View Page If Success Login
        } else {
            // Set The Seesion Value 
            $this->session->set_userdata('errorMsg', 'Enter Correct Email-Id and Password!!!');

            redirect('Project/day8/crud'); // Redirect On Index(Login) Page If Login Fail
        }
    }

    //insert
    public function saveRecord($tableName, $data)
    {
        // Insert Query
        $this->db->insert($tableName, $data);
        $insert = $this->db->insert_id();

        if ($insert > 0) { // IF Insert Is Greater Than 0
            // Set The Seesion Value 
            $this->session->set_userdata('successMsg', 'Record Inseted Successfully...');

            redirect('Project/day8/crud/view'); // Redirect On View Page If Record Inserted
        } else {
            // Set The Seesion Value 
            $this->session->set_userdata('errorMsg', "Record Can't Inserted!!!");

            redirect('Project/day8/crud/insert'); // Redirect On Insert Page If Record Can't Inserted
        }
    }

    // View
    public function viewRecords($tableName)
    {
        // Query for Select All Records
        $fetch = $this->db->get($tableName);
        return $fetch->result();
    }

    // Fetch Record According to Particular Id For Update
    public function fetchRecordById($tableName, $id)
    {
        // Query for Select Particular Record With Where Clause
        $this->db->where('id', $id);
        $fetch = $this->db->get($tableName);
        return $fetch->result();
    }

    // Update Record 
    public function updateRecord($tableName, $data, $id)
    {
        // Update Query
        $this->db->where('id', $id);
        $update = $this->db->update($tableName, $data);

        if ($update > 0) { // If Update Is Greater Than 0
            // Set The Seesion Value 
            $this->session->set_userdata('successMsg', 'Record Updated Successfully...');

            redirect('Project/day8/crud/view'); // Redirect On View Page If Record Updated
        } else {
            // Set The Seesion Value 
            $this->session->set_userdata('errorMsg', "Record Can't Updated!!!");

            redirect('Project/day8/crud/insert?id=' . $id . ''); // Redirect On Insert Page If Record Can't Updated
        }
    }

    // Delete Record
    public function deleteRecord($tableName, $id)
    {
        // Delete Query
        $this->db->where('id', $id);
        $delete = $this->db->delete($tableName);

        if ($delete) { // If Delete Is True
            // Set The Seesion Value 
            $this->session->set_userdata('successMsg', 'Record Deleted Successfully...');

            redirect('Project/day8/crud/view'); // Redirect On View Page If Record Deleted
        } else {
            $this->session->set_userdata('errorMsg', "Record Can't Deleted!!!");
            redirect('Project/day8/crud/view'); // Redirect On View Page If Record Can't Deleted
        }
    }
}
