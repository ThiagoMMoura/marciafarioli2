<div class="tool-bar">
    <div class="tool-bar-title">
        <label><?= strtoupper($title);?></label>
    </div>
    <?php
    $vars = array('limpar','salvar','excluir','editar','adicionar','buscar');
    $cont = 0;
    foreach($vars as $key => $nome){
        if(isset(${$nome})){
            $cont++;
        }
    }
    ?>
    <ul class="tool-bar-buttons tool-<?= $cont;?>">
        <?php if(isset($limpar)){ ?>
        <li>
            <button type="reset" name="limpar" class="button-tool" <?= isset($limpar['extra'])?$limpar['extra']:'';?>>
                <i class="fi-page-delete"></i>
                <label>Limpar</label>
            </button>
        </li>
        <?php } ?>
        <?php if(isset($salvar)){ ?>
        <li>
            <button type="submit" name="salvar" class="button-tool" <?= isset($salvar['extra'])?$salvar['extra']:'';?>>
                <i class="fi-save"></i>
                <label>Salvar</label>
            </button>
        </li>
        <?php } ?>
        <?php if(isset($excluir)){ ?>
        <li>
            <a name="excluir" class="button-tool" href="<?= isset($excluir['href'])?base_url($excluir['href']):'#';?>" <?= isset($excluir['extra'])?$excluir['extra']:'';?>>
                <i class="fi-trash"></i>
                <label>Excluir</label>
            </a>
        </li>
        <?php } ?>
        <?php if(isset($editar)){ ?>
        <li>
            <a name="editar" class="button-tool" href="<?= isset($editar['href'])?base_url($editar['href']):'#';?>" <?= isset($editar['extra'])?$editar['extra']:'';?>>
                <i class="fi-pencil"></i>
                <label>Editar</label>
            </a>
        </li>
        <?php } ?>
        <?php if(isset($adicionar)){ ?>
        <li>
            <a name="adicionar" class="button-tool" href="<?= isset($adicionar['href'])?base_url($adicionar['href']):'#';?>" <?= isset($adicionar['extra'])?$adicionar['extra']:'';?>>
                <i class="fi-plus"></i>
                <label>Adicionar</label>
            </a>
        </li>
        <?php } ?>
        <?php if(isset($buscar)){ ?>
        <li>
            <a name="buscar" class="button-tool" href="<?= isset($buscar['href'])?base_url($buscar['href']):'#';?>" <?= isset($buscar['extra'])?$buscar['extra']:'';?>>
                <i class="fi-magnifying-glass"></i>
                <label>Buscar</label>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>