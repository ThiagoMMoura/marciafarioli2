<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Classe que modela tabela Menu do Banco de Dados
 *
 * @author Thiago Moura
 */
class Menu_model extends MY_Model{
    public $nome;       //String
    public $descricao;  //String
    public $url;        //String
    public $grupo;      //String Agrupamento dos menus
    public $tipo;       //String Tipos(Separador,Imagem,Menu,Item,Botao,Acao,Link)
    public $formato;    //String Formatos(Aba,Link,Botao,Dropdown)
    public $icone;      //String html, link, id midia
    public $nivel;      //INT
    public $ordem;      //INT
    public $idmenupai;  //INT FK
    public $sistema;    //Boolean
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'menu';
        $this->sistema = FALSE;
    }
    
    public function Novo($campos){
        $this->setCampos($campos);
        return parent::inserir(FALSE);
    }
    
    public function NovoMenuSistema($campos){
        $campos['sistema'] = TRUE;
        return $this->Novo($campos);
    }
    
    public function NovoMenuSite($campos){
        $campos['sistema'] = FALSE;
        return $this->Novo($campos);
    }

    public function hasItensMenu($id = NULL){
        $this->getItensMenu($id);
        return $this->getNumRows()>0;
    }
    
    public function hasPermissao($idmenu=NULL,$para='consultar'){
        
    }
    
    public function getLink(){
        return site_url($this->url);
    }
    
    public function getItensMenu($id = NULL){
        if($id===NULL){
            $id = $this->getId();
        }
        $this->selecionar('*', array('idmenupai'=>$id));
        return $this->getResultados();
    }
    
    public function getMenuHTML($menu = NULL){
        if($menu===NULL){
            $menu = $this;
        }
        if($menu->hasItensMenu()) {?>
            <li class="has-dropdown">
                <?=anchor($menu->url,$menu->nome); ?>
                <ul class="dropdown">
                    <?foreach($menu->getResultados() as $item){
                        echo $item->getMenuHTML();
                    }?>
                </ul>
            </li>
        <?}else{
            if($menu->tipo!='Separador'){?>
                <li><?php echo anchor($menu->url,$menu->nome); ?></li>
            <?}else{
                echo '<li class="divider"></li>';
            }
        }
    }
}
