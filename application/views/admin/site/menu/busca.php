<div class="row">
<?php
if(isset($menus)){?>
    <table>
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Menu Pai</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($menus as $menu){?>
            <tr>
                <td><?= $menu['grupo'];?></td>
                <td><?= $menu['nome'];?></td>
                <td><?= $menu['descricao'];?></td>
                <?php 
                $menupai = " - ";
                foreach($menus as $pai){
                    if($menu['idmenupai']===$pai['id']){
                        $menupai = $pai['id'] . ' - ' . $pai['nome'];
                        break;
                    }
                }?>
                <td><?= $menupai;?></td>
                <td><?= anchor('admin/site/menu/editar/' . $menu['id'], 'Editar');?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
<?php }else{
    echo '<p>Nenhum menu encontrado</p>';
}?>
</div>

