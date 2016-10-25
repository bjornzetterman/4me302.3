<?php
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

//check that we have some input
    if (empty($_POST['message']))
        $errors['message'] = 'You didnt type any note in the field.';

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

        // if there are no errors process our form, then return a message
		error_log("--".$_POST['message']. "--"); //This is just to show that something is needed to be done. like store it in somewhre.
	
        // values to return...
        $data['success'] = true;
        $data['message'] = 'Success!';
    }
    // return all our data to an AJAX call, JSON format
    echo json_encode($data);
	?>