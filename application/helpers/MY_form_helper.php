<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @deprecated since version 1
 * @param mixed $form_input
 * @param mixed $form_label
 * @param mixed $datalist
 * @param type $help_text
 * @return string
 */
function get_form_field_input($form_input, $form_label = NULL, $datalist = array(), $help_text = NULL){
    $form_html = '';
    
    if(!is_array($form_input)){
        $nome = $form_input;
        $form_input = array('name'=>$nome);
    }
    
    $form_error = form_error($form_input['name']);
    $error = $form_error != NULL? 'error' : '';
    
    $form_datalist = '';
    if(!empty($datalist)){
        $datalist['id'] = $form_input['name'];
        $form_input['list'] = $form_input['name'];
        $form_datalist = form_datalist($datalist);
    }
    
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
            $defaults = array('name' => $data,'id' => $data);
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

/**
 * 
 * @param mixed $data
 * @param mixed $label
 * @param mixed $extra
 * @param mixed $datalist
 * @param mixed $options
 * @param mixed $selected
 * @return string
 */
function get_form_field($data = '',$label = '',$extra = '',$datalist = '',$options = [],$selected = ''){
    $field = array();
    $error = '';
    if(is_array($data)){
        
        if(isset($data['label'])){
            $label = $data['label'];
            unset($data['label']);
        }
        if(isset($data['datalist'])){
            $datalist = $data['datalist'];
            unset($data['datalist']);
        }
        if(isset($data['options'])){
            $options = $data['options'];
            unset($data['options']);
        }
        if(isset($data['selected'])){
            $selected = $data['selected'];
            unset($data['selected']);
        }
        if(isset($data['textarea'])){
            $field = array('textarea'=>$data['textarea']);
        }elseif(isset($data['dropdown'])){
            $field = array('dropdown'=>$data['dropdown']);
        }elseif(isset($data['multiselect'])){
            $field = array('multiselect'=>$data['multiselect']);
        }elseif(isset($data['button'])){
            $field = array('button'=>$data['button']);
        }elseif(isset($data['input'])){
            $field = array('input'=>$data['input']);
        }else{
            $field = array('input'=>$data);
        }
    }else{
        $field = array('input'=>$data);
    }
    
    if(isset($field['textarea'])){
        $field['html'] = form_textarea($field['textarea'],'',$extra);
        $error = form_error(is_array($field['textarea'])?$field['textarea']['name']:$field['textarea']);
    }elseif(isset($field['dropdown'])){
        $field['html'] = form_dropdown($field['dropdown'],$options,$selected,$extra);
        $error = form_error(is_array($field['dropdown'])?$field['dropdown']['name']:$field['dropdown']);
    }elseif(isset($field['multiselect'])){
        $field['html'] = form_multiselect($field['multiselect'],$options,$selected,$extra);
        $error = form_error(is_array($field['multiselect'])?$field['multiselect']['name']:$field['multiselect']);
    }elseif(isset($field['button'])){
        $field['html'] = form_button($field['button'],'',$extra);
    }else{
        $field['html'] = form_input($field['input'],'',$extra);
        $error = form_error(is_array($field['input'])?$field['input']['name']:$field['input']);
    }
    
    if($error!=NULL){
        $field['html'] = _add_class_to('error', $field['html']);
    }
    
    if($label!=NULL){
        if(is_array($label)){
            $field['html'] = form_label($label['text'].$field['html'],$label['id'],$label['attributes']);
        }else{
            $field['html'] = form_label($label.$field['html']);
        }
        if($error!=NULL){
            $field['html'] = _add_class_to('error', $field['html']);
        }
    }
    
    if($datalist!=NULL){
        $field['html'] .= form_datalist($datalist,$options,$selected,$extra);
    }
    
    return $field['html'] . $error;
}

function _add_class_to($class,$html){
    $before_class = stristr($html, 'class="', TRUE);
    $middle_class = '';
    $after_class = '';
    
    if($before_class===FALSE){
        
        $after_class = stristr($html,'>');
        $before_class = str_replace($after_class,'',$html);
        $middle_class = 'class="' . $class . '"';
    }else{
        $after_class = substr(stristr($html,'class="'),7);
        $middle_class = stristr($after_class, '"', TRUE);
        $after_class = str_replace($middle_class,'',$after_class);
        $middle_class = 'class="' . $middle_class . ' ' . $class;
    }
    
    return $before_class . $middle_class . $after_class;
}

