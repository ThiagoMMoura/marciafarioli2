<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_form_field($form_input, $form_label = NULL, $datalist = array(), $help_text = NULL){
    $form_html = '';
    
    if(!is_array($form_input)){
        $nome = $form_input;
        $form_input = array();
        $form_input['name'] = $nome;
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
        }else{
            $form_label = array();
        }
        
        $form_label['class'] = isset($form_label['class']) ? $form_label['class'] . ' ' . $error : $error;
        
        $form_html .= form_label($label_nome.$input_html,'',$form_label);
    }else{
        $form_html .= $input_html;
    }
    
    $form_datalist = '';
    if(!empty($datalist)){
        $datalist['id'] = $form_input['name'];
        $form_datalist = form_datalist($datalist);
    }
    $form_html .= $form_error.$form_datalist;
    
    return $form_html;
}

/**
* Datalist form
*
* @param	mixed	$data
* @param	mixed	$options
* @param	mixed	$selected
* @param	mixed	$extra
* @return	string
*/
function form_datalist($data = '', $options = array(),$selected = '',$extra = ''){
    
    $defaults = array();

    if (is_array($data))
    {
            if (isset($data['selected']))
            {
                    $selected = $data['selected'];
                    unset($data['selected']); // select tags don't have a selected attribute
            }

            if (isset($data['options']))
            {
                    $options = $data['options'];
                    unset($data['options']); // select tags don't use an options attribute
            }
    }
    else
    {
            $defaults = array('name' => $data);
    }
    
    is_array($selected) OR $selected = array($selected);
    is_array($options) OR $options = array($options);
    
    // If no selected state was submitted we will attempt to set it automatically
    if (empty($selected))
    {
            if (is_array($data))
            {
                    if (isset($data['name'], $_POST[$data['name']]))
                    {
                            $selected = array($_POST[$data['name']]);
                    }
            }
            elseif (isset($_POST[$data]))
            {
                    $selected = array($_POST[$data]);
            }
    }
    
    $extra = _attributes_to_string($extra);
    
    $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';
    
    $form = '<datalist '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";
    
    foreach ($options as $key => $val)
    {
            $key = (string) $key;

            if (is_array($val))
            {
                    if (empty($val))
                    {
                            continue;
                    }

                    $form .= '<optgroup label="'.$key."\">\n";

                    foreach ($val as $optgroup_key => $optgroup_val)
                    {
                            $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                            $form .= '<option value="'.html_escape($optgroup_key).'"'.$sel.'>'
                                    .(string) $optgroup_val."</option>\n";
                    }

                    $form .= "</optgroup>\n";
            }
            else
            {
                    $form .= '<option value="'.html_escape($key).'"'
                            .(in_array($key, $selected) ? ' selected="selected"' : '').'>'
                            .(string) $val."</option>\n";
            }
    }

    return $form."</datalist>\n";
}

