<?php

    class ProdutoService {
        
        private $repository;

        public function __construct() {
            $this->repository = new EstoqueRepository();
        }

        public function cadastrar(Produto $produto): bool {
            return $this->repository->fnAddProduto($produto);
        }
        
        public function atualizar(Produto $produto): bool {
            return $this->repository->fnUpdateProduto($produto);
        }
        
        public function atualizarCategoria(Produto $produto): bool {
            return $this->repository->fnUpdateCategoriaProduto($produto);
        }
        
        public function listar($limit = 9999) {
            return $this->repository->fnListProdutos($limit);
        }
        
        public function localizar($id) {
            return $this->repository->fnLocalizarProduto($id);
        }
    } 