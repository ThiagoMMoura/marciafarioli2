<div class="row">
<?php
if(isset($logs)){?>
    <table>
        <thead>
            <tr>
                <th>Arquivos de Log</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($logs as $log){?>
            <tr>
                <td><?= anchor('admin/sistema/log/arquivo/' . $log, $log);?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
<?php }else{
    echo '<p>Nenhum arquivo de log encontrado</p>';
}?>
</div>

