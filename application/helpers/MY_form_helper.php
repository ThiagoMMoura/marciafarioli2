<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_form_field($form_input, $form_label = NULL, $help_text = NULL){
    $form_html = '';
    
    if(!is_array($form_input)){
        $form_input['name'] = $form_input;
    }
    
    $form_error = form_error($form_input['name']);
    $error = $form_error != NULL? 'error' : '';
    
    $form_input['class'] = isset($form_input['class'])? $form_input['class'] . ' ' . $error : $error;
    $input_html = form_input($form_input);
    
    if($form_label !== NULL){
        $label_nome = $form_label;
        
        if(is_array($form_label)){
            $label_nome = $form_label['text'];
            unset($form_label['text']);
        }
        
        $form_label['class'] = isset($form_label['class']) ? $form_label['class'] . ' ' . $error : $error;
        
        $form_html .= form_label($label_nome.$input_html,'',is);
    }else{
        $form_html .= $input_html;
    }
    
    $form_html .= $form_error;
    
    return $form_html;
}

