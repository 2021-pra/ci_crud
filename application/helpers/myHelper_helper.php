<?php

function pre_r($var)
{
    if (is_array($var)) {
        return print_r($var);
    } else {
        return var_dump($var);
    }
}

function image_Upload()
{
    // Assign CI Object To a Variable
    $ci = get_instance();

    $config['upload_path'] = 'C:/xampp/htdocs/Project/day8/application/images/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 5000;

    // Load Upload Library And Pass Data OF the Image
    $ci->load->library('upload', $config);

    if (!$ci->upload->do_upload('profile')) {
        $error = array('errorUpload' => $ci->upload->display_errors());

        echo "<script>alert('$error[errorUpload]');</script>";
    } else {
        // Get Uploaded Image Name
        $image['image_metadata'] = $ci->upload->data();
        $profile = $image['image_metadata']['file_name'];
        return $profile;
    }
}
