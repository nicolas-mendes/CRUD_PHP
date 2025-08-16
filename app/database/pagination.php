<?php 
    namespace App\database;
    
    class pagination
    {   
        /** @var integer $limit número máximo de registros por página */
        private $limit;

        /** @var integer $results Quantidade total de resultados da DB */
        private $results;

        /** @var integer $pages Quantidade total de páginas */
        private $pages;

        /** @var integer $currentPage Página Atual */
        private $currentPage;


        /**
         * Construtor da classe Pagination
         * @param integer $results 
         * @param integer $currentPage 
         * @param integer $limit 
         **/
        public function __construct($results,$currentPage=1,$limit=20)
        {
            $this->results = $results;
            $this->limit = $limit;
            $this->currentPage = (is_numeric($currentPage) AND $currentPage > 0) ? $currentPage : 1;
            $this->calculate();
        }

        /**
         * Método responsável por cálcular a paginação
         * @return integer
         **/
        private function calculate()
        {
            $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

            //VERIFICA SE A PÁGINA ATUAL ESTA DENTRO DO LIMITE
            $this->currentPage =  $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
        }

        /**
         * Método Responsável por retornar a cláusula limit do MySQL
         * @return string
         **/
        public function getLimit()
        {
            $offset = ($this->limit * ($this->currentPage - 1));
            return $offset.','.$this->limit;
        }

        /**
         * Método responsável por retornar as opções de páginas disponíveis 
         * @return array
         **/
        public function getPages()
        {
            //NÃO RETORNA PÁGINAS
            if($this->pages == 1) return [];

            //PÁGINAS
            $paginas = [];
            for($i=1; $i<=$this->pages;$i++)
            {
                $paginas [] = 
                [
                    'pagina' => $i,
                    'atual' => $i == $this->currentPage
                ];
            }

            return $paginas;
        }
    }

?>