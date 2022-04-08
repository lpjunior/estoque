<?php
    //======================================================================
    // Entity class
    //======================================================================

    //-----------------------------------------------------
    // Descrição do recurso
    //-----------------------------------------------------

    /* É uma classe que modela objetos (abstratas ou não) cuja informação e o 
       comportamento associado são, de maneira geral, persistentes, podendo ser 
       armazenados num arquivo ou banco de dados. 
    */

    class Categoria {

        private int $id;
        private string $nome;

        # encapsulamento
        public function getId():int{
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        # magic method (toString)
        public function __toString() {
            return json_encode(array(
                "id" => $this->getId(),
                "nome" => $this->getNome()
            ));
        }
    }