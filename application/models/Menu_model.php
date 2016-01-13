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
    public $permissao;  //String (consultar,incluir,editar,excluir)
    public $icone;      //String html, link, id midia
    public $nivel;      //INT
    public $ordem;      //INT
    public $idmenupai;  //INT FK
    public $sistema;    //Boolean True para os menus que precisam de permissão e False para os demais.
    
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
    
    public function hasPermissao($idmenu=NULL){
        if($idmenu===NULL){
            $idmenu = $this->getId();
        }else if(!is_numeric($idmenu)){
            $idmenu = $this->config->item($idmenu);
        }
        $this->getObjectById($idmenu);
        
        foreach($this->session->permissoes as $permissao){
            if($permissao['idmenu']==$idmenu){
                return $permissao[$this->permissao];
            }
        }
        return FALSE;
    }
    
    public function getLink(){
        return site_url($this->url);
    }
    
    public function getItensMenu($id = NULL){
        if($id===NULL){
            $id = $this->getId();
        }
        $this->selecionar('*', array('idmenupai'=>$id),'grupo ASC, ordem ASC');
        return $this->getResultados();
    }
    
    public function getMenuHTML($menu = NULL){
        if($menu===NULL){
            $menu = $this;
        }
        if($menu->sistema&&!$menu->hasPermissao()){
            return;
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
    
    public function get_lista_tipos(){
        return array('acao','botao','imagem','item','link','menu','separador');
    }
    
    public function get_lista_formatos(){
        return array('aba','botao','dropdown','input','link');
    }
    
    public function get_lista_permissoes(){
        return array('consultar','incluir','editar','excluir');
    }
    
    /**
     * Retorna o maior número de ordem do menu de um nivel.
     * 
     * @param string $grupo
     * @param int $idmenupai
     * @return int
     */
    public function get_max_ordem($nivel,$idmenupai,$sistema = FALSE){
        if($nivel==NULL){
            $nivel = $this->nivel;
        }
        if($idmenupai==NULL){
            $idmenupai = $this->idmenupai;
        }
        $this->db->select_max('ordem');
        $where['nivel'] = $nivel;
        $where['idmenupai'] = $idmenupai;
        $where['sistema'] = $sistema;
        $result = $this->selecionar('*',$where);
        return isset($result[0])?$result[0]['ordem']:0;
    }
}
