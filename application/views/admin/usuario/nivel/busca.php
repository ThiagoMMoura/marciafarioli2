<?php ?>
<div class="row">
    <h1 class="text-center">Busca níveis de permissões para usuários</h1>
</div>
<div class="row">
    <table class="hover">
        <thead>
            <tr>
                <th width="150">Nome</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <? $this->nivel_model->selecionar('*',NULL,'nome');
            foreach($this->nivel_model->getResultados() as $nivel){ ?>
                <tr>
                    <th><?=$nivel->nome;?></th>
                    <th><?=$nivel->descricao;?></th>
                </tr>
            <? } ?>
        </tbody>
    </table>
</div>