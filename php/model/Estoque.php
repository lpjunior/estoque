<?php

    class Estoque {

        private int $id;
        private string $datacadastro;
        private int $qtdmin;
        private int $qtdmax;
        private int $qtdatual;
        private int $produtoid;
        private string $criadoem;

        # encapsulamento
        public function getId():int{
            return $this->id;
        }

        public function setId($id): void {
            $this->id = $id;
        }

        public function getDataCadastro() {
            return $this->datacadastro;
        }

        public function setDataCadastro($datacadastro): void {
            $this->datacadastro = $datacadastro;
        }

        public function getQtdMin(): int {
            return $this->qtdmin;
        }

        public function setQtdMin($qtdmin): void {
            $this->qtdmin = $qtdmin;
        }

        public function getQtdMax(): int {
            return $this->qtdmax;
        }

        public function setQtdMax($qtdmax): void {
            $this->qtdmax = $qtdmax;
        }

        public function getQtdAtual(): int {
            return $this->qtdatual;
        }

        public function setQtdAtual($qtdatual): void {
            $this->qtdatual = $qtdatual;
        }

        public function getProdutoId(): int {
            return $this->produtoid;
        }

        public function setProdutoId($produtoid): void {
            $this->produtoid = $produtoid;
        }

        public function getCriadoEm(): string {
            return date('d/m/Y - H:i:s', strtotime($this->criadoem));
        }

        public function setCriadoEm(string $criadoem): void {
            $this->criadoem = $criadoem;
        }
    }