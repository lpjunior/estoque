<?php

    class Estoque {

        private int $id;
        private string $dataCadastro;
        private int $qtdMin;
        private int $qtdMax;
        private int $qtdAtual;
        private int $produtoId;

        # encapsulamento
        public function getId():int{
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getDataCadastro() {
            return $this->dataCadastro;
        }

        public function setDataCadastro($dataCadastro) {
            $this->dataCadastro = $dataCadastro;
        }

        public function getQtdMin(): int {
            return $this->qtdMin;
        }

        public function setQtdMin($qtdMin) {
            $this->qtdMin = $qtdMin;
        }

        public function getQtdMax(): int {
            return $this->qtdMax;
        }

        public function setQtdMax($qtdMax) {
            $this->qtdMax = $qtdMax;
        }

        public function getQtdAtual(): int {
            return $this->qtdAtual;
        }

        public function setQtdAtual($qtdAtual) {
            $this->qtdAtual = $qtdAtual;
        }

        public function getProdutoId(): int {
            return $this->produtoId;
        }

        public function setProdutoId($produtoId) {
            $this->produtoId = $produtoId;
        }

        # magic method (toString)
        public function __toString() {
            return json_encode(array(
                "id" => $this->getId(),
                "dataCadastro" => $this->getDataCadastro(),
                "qtdMin" => $this->getQtdMin(),
                "qtdMax" => $this->getQtdMax(),
                "qtdAtual" => $this->getQtdAtual(),
                "produtoId" => $this->getProdutoId()
            ));
        }
    }