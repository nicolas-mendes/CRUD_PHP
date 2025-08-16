<?php 
    namespace App\entity;
    use App\database\database;
    use \PDO;

    class usuario 
    {
        /**
         * Identificador Único do Usuário utilizando 
         * @var string
         * @example "123e4567-e89b-12d3-a456-426614174000"
         */
        public $id;

        /**
         * Nome do Usuário
         * @var string
         */
        public $nome;

        /**
         * E-Mail do Usuário
         * @var string
         */
        public $email;

        /**
         * Senha do Usuário
         * @var string
         * @see https://www.php.net/manual/pt_BR/function.password-hash.php
         */
        public $senha;

        /**
         * Data de Nascimento do Usuário
         * @var string
         */
        public $nasc;


        /**
         * Gera um Identificador Único Universal (UUID) versão 4, compatível com a RFC 4122.
         * @internal Este é um método de apoio interno para a geração de IDs únicos.
         * @return string Retorna o UUID como uma string de 36 caracteres.
         * @see https://www.rfc-editor.org/rfc/rfc4122 A especificação oficial do UUID.
         */

        private function guidv4()
        {
            // Gera 16 bytes (128 bits) de dados aleatórios e criptograficamente seguros.
            $data = random_bytes(16);

            // Define os 4 bits mais significativos do 7º byte para 0100, indicando a versão 4.
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);

            // Define os 2 bits mais significativos do 9º byte para 10, indicando a variante RFC 4122.
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

            // Formata os 16 bytes hexadecimais no padrão UUID xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        /**
         * Método para cadastrar novos usuários no Banco de Dados
         * @return boolean
         */

        public function cadastrar()
        {
            //DEFINIR ID
            $this->id = $this->guidv4(); 
            $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);

            //INSERIR O USUÁRIO NO BANCO DE DADOS
            $obDatabase = new database('usuario');
            $obDatabase->insert
            ([
                'id' => $this->id,
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $senhaHash,
                'nasc' => $this->nasc
            ]);

            //RETORNAR SUCESSO
            return true;
        }

        /**
         * Método responsável por atualizar os campos de um Usuário na DB
         * @return boolean
         **/
        public function atualizar()
        {
            // PREPARA OS DADOS PARA A ATUALIZAÇÃO
            $dadosAtualizar = [
                'id'    => $this->id,
                'nome'  => $this->nome,
                'email' => $this->email,
                'nasc'  => $this->nasc
            ];

            // VERIFICA SE UMA NOVA SENHA FOI FORNECIDA E NÃO ESTÁ VAZIA
            if (!empty($this->senha)) {
                $dadosAtualizar['senha'] = password_hash($this->senha, PASSWORD_DEFAULT);
            }

            // ATUALIZA OS DADOS NO BANCO
            return (new database('usuario'))->update("id = '" . $this->id . "'", $dadosAtualizar);
        }

        /**
         * Método de Exclusão de um usuário da DB
         * @return boolean
         **/
        public function excluir()
        {
            return (new database('usuario'))->delete("id = '".$this->id."'");
        }

        /**
         * Método responsável por extrair os usuários da DB
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return array
         **/
        public static function getUsuarios($where = null,$order = null,$limit = null)
        {
            return (new database('usuario'))->select($where,$order,$limit)
                                          ->fetchAll(PDO::FETCH_CLASS,self::class);
        }

        /**
         * Método responsável por extrair o Total de usuários da DB
         * @param string $where
         * @return integer
         **/
        public static function getTotalUsuarios($where = null)
        {
            return (new database('usuario'))->select($where,null,null,'COUNT(*) as qtd')
                                          ->fetchObject()
                                          ->qtd;
        }
        
        /**
         * Método responsável por extrair UM usuário da DB
         * @param string $id
         * @return usuario
         **/
        public static function getUsuario($id)
        {
            return (new database('usuario'))->select("id = '".$id."'")
                                            ->fetchObject(self::class);
        }
    }

?>