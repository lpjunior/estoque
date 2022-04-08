<?php

    class EstoqueService {
        
        private $repository;

        public function __construct() {
            $this->repository = new EstoqueRepository();
        }

        public function cadastrar(Estoque $estoque) {
            return $this->repository->fnAddEstoque($estoque);
        }
    } 