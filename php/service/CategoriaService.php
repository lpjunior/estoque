<?php

    class CategoriaService {
        
        private $repository;

        public function __construct() {
            $this->repository = new EstoqueRepository();
        }

        public function cadastrar(Categoria $categoria) {
            return $this->repository->fnAddCategoria($categoria->getNome());
        }
    } 