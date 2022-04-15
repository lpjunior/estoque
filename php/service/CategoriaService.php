<?php

    class CategoriaService {
        
        private $repository;

        public function __construct() {
            $this->repository = new EstoqueRepository();
        }

        public function cadastrar(Categoria $categoria): bool {
            return $this->repository->fnAddCategoria($categoria);
        }
        
        public function listar($limit) {
            return $this->repository->fnListCategorias($limit);
        }
        
        public function listarComQuantidade($limit) {
            return $this->repository->fnListCategoriasQuantidade($limit);
        }
        
        public function LocalizarPorIds($ids) {
            return $this->repository->fnListCategoriasIn($ids);
        }
    } 