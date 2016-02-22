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
    /**
     * @var string <b>Nome</b> do menu para exibição.
     */
    public $nome;
    /**
     * @var string Descrição da função do menu. 
     */
    public $descricao;
    /**
     * @var string Define uma <b>URL</b> interna ou externa ao sistema.
     */
    public $url;
    /**
     * @var string Define um grupo de menus. 
     */
    public $grupo;
    public $tipo;       //String Tipos(Separador,Imagem,Menu,Item,Botao,Acao,Link)
    public $formato;    //String Formatos(Aba,Link,Botao,Dropdown)
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
    
    /**
     * Retorna <b>TRUE</b> se o menu possui itens de menu filhos.
     * 
     * @param int $id
     * @return boolean
     */
    public function hasItensMenu($id = NULL){
        if($id==NULL){
            $id = $this->getId();
        }
        $this->selecionar('*','idmenupai = ' . $id);
        return $this->getNumRows()>0;
    }
    
    /**
     * @deprecated since version 0.3
     * @param type $idmenu
     * @return boolean
     */
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
    
    /**
     * Retorna um <b>array</b> com todos os itens de menu filhos relacionados a id passada
     * por parâmetro.
     * 
     * @param int $id
     * @return array
     */
    public function get_itens_menu($id = NULL){
        if($id===NULL){
            $id = $this->getId();
        }
        $this->selecionar('*', array('idmenupai'=>$id),'grupo ASC, ordem ASC');
        return $this->getResultadosArray();
    }
    
    /**
     * @deprecated since version 0.3
     * @param type $menu
     * @return type
     */
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
        return array('item','menu','posicao','secao');
    }
    
    /**
     * 
     * @param string $tipo
     * @return array
     */
    public function get_lista_formatos($tipo = ''){
        switch($tipo){
            case 'item': return array('button','divider','label','link');
            case 'menu': return array('dropdown','link');
            case 'posicao': return array('direita','esquerda');
            case 'secao': return array('section');
            default: return array('button','direita','divider','dropdown','esquerda','label','link','section');
        }
    }
    
    /**
     * Retorna o maior número de ordem do menu de um nivel.
     * 
     * @param int $idmenupai
     * @return int
     */
    public function get_max_ordem($idmenupai = '',$sistema = FALSE){
        if($idmenupai==NULL){
            $idmenupai = $this->idmenupai;
        }
        $this->db->select_max('ordem');
        $where['idmenupai'] = $idmenupai;
        $where['sistema'] = (string) $sistema;
        $result = $this->selecionar('grupo',$where);
        
        return array_key_exists(0, $result)?$result[0]['ordem']:0;
    }
    
    /**
     * Retorna uma arvore de menus correspondente a pesquisa.
     * 
     * @param string $colunas
     * @param mixed $where
     * @param mixed $ordem_by
     * @param string $indexador
     * @return matriz
     */
    public function get_arvore_menus($colunas = '*', $where = '',$ordem_by = '',$indexador = ''){
        
        $menus = $this->selecionar($colunas, $where, $ordem_by);
        
        $arvore = array();
        foreach($menus as $key => $menu){
            if($this->hasItensMenu($menu['id'])){
                $menu = array_merge($menu,$this->get_arvore_menus($colunas,'idmenupai = ' . $menu['id'],$ordem_by,$indexador));
            }
            if($indexador!=NULL){
                $arvore[$menu[$indexador]] = $menu;
            }else{
                $arvore[$key] = $menu;
            }
        }
        
        return $arvore;
    }
}
