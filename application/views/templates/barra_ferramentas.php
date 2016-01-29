<div class="tool-bar">
    <div class="tool-bar-title">
        <label><?= strtoupper($title);?></label>
    </div>
    <ul class="tool-bar-buttons">
        <?php if(isset($limpar)){ ?>
        <li class="text-center right">
            <button type="reset" name="limpar" class="button-tool" <?= isset($limpar['extra'])?$limpar['extra']:'';?>>
                <i class="fi-page-delete"></i>
                <label>Limpar</label>
            </button>
        </li>
        <?php } ?>
        <?php if(isset($salvar)){ ?>
        <li class="text-center right">
            <button type="submit" name="salvar" class="button-tool" <?= isset($salvar['extra'])?$salvar['extra']:'';?>>
                <i class="fi-save"></i>
                <label>Salvar</label>
            </button>
        </li>
        <?php } ?>
        <?php if(isset($excluir)){ ?>
        <li class="text-center right">
            <a name="excluir" class="button-tool" href="<?= isset($excluir['href'])?base_url($excluir['href']):'#';?>" <?= isset($excluir['extra'])?$excluir['extra']:'';?>>
                <i class="fi-trash"></i>
                <label>Excluir</label>
            </a>
        </li>
        <?php } ?>
        <?php if(isset($editar)){ ?>
        <li class="text-center right">
            <a name="editar" class="button-tool" href="<?= isset($editar['href'])?base_url($editar['href']):'#';?>" <?= isset($editar['extra'])?$editar['extra']:'';?>>
                <i class="fi-pencil"></i>
                <label>Editar</label>
            </a>
        </li>
        <?php } ?>
        <?php if(isset($adicionar)){ ?>
        <li class="text-center right">
            <a name="adicionar" class="button-tool" href="<?= isset($adicionar['href'])?base_url($adicionar['href']):'#';?>" <?= isset($adicionar['extra'])?$adicionar['extra']:'';?>>
                <i class="fi-plus"></i>
                <label>Adicionar</label>
            </a>
        </li>
        <?php } ?>
        <?php if(isset($buscar)){ ?>
        <li class="text-center right">
            <a name="buscar" class="button-tool" href="<?= isset($buscar['href'])?base_url($buscar['href']):'#';?>" <?= isset($buscar['extra'])?$buscar['extra']:'';?>>
                <i class="fi-magnifying-glass"></i>
                <label>Buscar</label>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>