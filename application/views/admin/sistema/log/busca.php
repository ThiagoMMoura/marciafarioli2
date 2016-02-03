<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca Logs';
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($logs) && !empty($logs)){?>
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
                $data['warning'] = $this->lang->line('warning_no_registration_found');
                $this->load->view('templates/alertas',$data);
            }?>
        </div>
    </div>
</div>

