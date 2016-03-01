<?php
$this->load->view('templates/alertas');
// Declaração de arrays de inputs, labels e hiddens.
$hidden['idusuario'] = set_value('idusuario', $idusuario);
$field['nome'] = array(
    'input' =>  array('name' => 'nome', 'placeholder' => 'Nome Completo', 'value' => set_value('nome',$nome), 'required' => ''),
    'label' => 'Nome Completo'
);
$field['email'] = array(
    'input' => array('name' => 'email', 'placeholder' => 'Seu email', 'value' => set_value('email',$email), 'required' => ''),
    'label' => 'Email'
);
$field['feminino'] = array(
    'input' => array('name' => 'sexo', 'type' => 'radio', 'value' => 'Feminino'),
    'label' => array('text' => '<i class="fi-female"></i> Feminino','for'=>'feminino','posicao'=>'depois'),
    'extra' => set_radio('sexo','Feminino',$sexo==='Feminino')
);
$field['masculino'] = array(
    'input' => array('name' => 'sexo', 'type' => 'radio', 'value' => 'Masculino'),
    'label' => array('text' => '<i class="fi-male"></i> Masculino','for'=>'masculino','posicao'=>'depois'),
    'extra' => set_radio('sexo','Masculino',$sexo==='Masculino')
);
$field['nivel'] = array(
    'dropdown' => array('name' => 'idnivel', 'placeholder' => 'Selecione um nível...'),
    'label' => 'Nivel',
    'options' => $niveis,
    'selected' => set_value('idnivel',$idnivel)
);
$field['senha'] = array(
    'input' => array('name' => 'senha', 'placeholder' => 'Senha', 'required' => '','type' => 'password'),
    'label' => 'Senha'
);
?>
<div class="row">
    <div class="medium-12 medium-centered columns">
        <?php echo form_open('admin/usuario/conta/salvar', '', $hidden); ?>
            <?php 
            $ferramentas['title'] = 'Cadastro de UsuÁrio';
            $ferramentas['limpar'] = TRUE;
            $ferramentas['salvar'] = TRUE;
            $ferramentas['adicionar'] = array('href'=>'admin/usuario/conta/cadastro');
            $ferramentas['buscar'] = array('href'=>'admin/usuario/conta/busca');
            $this->load->view('templates/barra_ferramentas',$ferramentas);
            ?>
            <div class="panel">
                <div class="row">
                    <div class="large-12 columns">
                        <?= get_form_field($field['nome']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <?= get_form_field($field['email']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns<?= (form_error('sexo') != NULL) ? ' error':''; ?>">
                        <?php
                        echo form_label('Sexo');
                        echo get_form_field($field['masculino']);
                        echo get_form_field($field['feminino']);
                        echo form_error('sexo');
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <?= get_form_field($field['nivel']);?>
                    </div>
                </div>
                <?php if(!$idusuario){ ?>
                    <div class="row">
                        <div class="large-12 columns">
                            <?= get_form_field($field['senha']);?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

