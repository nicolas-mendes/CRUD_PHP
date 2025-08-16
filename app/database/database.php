<?php 
    namespace App\database;
    use \PDO;
    use \PDOException;

    class database
    {   
        /**
         * Credenciais de acesso ao MySQL
         */
        const HOST = 'localhost';
        const USER = 'root';
        const PASS = '';
        const DB = 'cadastrousuarios';
        private $table;
        private $connection;

        /**
         * Define a tabela e instâncias de conexão
         * @param string $table
         */
        public function __construct($table = null)
        {
            $this->table = $table;
            $this->setConnection();
        }

        /**
         * Método para gerar uma conexão com o Banco de Dados
         */
        private function setConnection()
        {
            try 
            {
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::DB,self::USER,self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } 
            catch (PDOException $er) 
            {
                die('ERROR: '.$er->getMessage());
            }
        }

        /**
         * Método de inserção de dados na DB
         * @param array $values [ field => value]
         * @return integer        
         **/
        public function insert($values)
        {
            //DADOS DA QUERRY
            $fields = array_keys($values);
            $binds = array_pad([],count($fields),'?');

            //MONTAGEM DA QUERRY
            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') values('.implode(',',$binds).')';

            //EXECUÇÃO DO INSERT
            $this->execute($query,array_values($values));

            //RETORNA O ID INSERIDO
            return $this->connection->lastInsertId();

        }
        
        /**
         * Método de execução da querry na DB
         * @param string $query
         * @param array $params
         * @return PDOStatement
         **/
        public function execute($query,$params = [])
        {
            try 
            {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            }           
            catch (\PDOException $er) 
            {
                die('ERROR: '.$er->getMessage());
            }
        }

        /**
         * Método de execução de consulta na DB
         * @param string $where
         * @param string $order
         * @param string $limit
         * @param string $fields
         * @return PDOStatement
         **/
        public function select($where = null,$order = null,$limit = null, $fields = '*')
        {
            //DADOS DA QUERY
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';

            //MONTAGEM DA QUERY
            $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            //EXECUTA A QUERRY
            return $this->execute($query);
        }

        /**
         * Método que executa uma atualização dos campos na DB

         * @param string $where
         * @param array $values
         * @return boolean
         **/
        public function update($where,$values)
        {
            //DADOS DA QUERY
            $fields = array_keys($values);
            
            //MONTA A QUERY
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
            
            //EXECUTA A QUERY
            $this->execute($query,array_values($values));

            return true;
        }

        /**
         * Método de exclusão de uma row na DB
         * @param string $where
         * @return boolean
         **/
        public function delete($where)
        {

            //MONTAGEM DA QUERY
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where.' LIMIT 1';
            
            
            //EXECUTA A QUERRY
            $this->execute($query);

            return true;
        }

    }
?>