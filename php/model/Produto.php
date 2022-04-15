<?php

class Produto
{
    private int $id;
    private string $nome;
    private string $descricao;
    private float $valorcompra;
    private float $valorvenda;
    private bool $status;
    private int $categoriaid;
    private string $criadoem;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void {
        $this->descricao = $descricao;
    }

    public function getValorCompra(): float {
        return $this->valorcompra;
    }

    public function setValorCompra($valorcompra): void {
        $this->valorcompra = $valorcompra;
    }

    public function getValorVenda(): float{
        return $this->valorvenda;
    }

    public function setValorVenda($valorvenda): void {
        $this->valorvenda = $valorvenda;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function getCategoriaId(): int {
        return $this->categoriaid;
    }

    public function setCategoriaId($categoriaid): void {
        $this->categoriaid = $categoriaid;
    }

    public function getCriadoEm(): string {
        return date('d/m/Y - H:i:s', strtotime($this->criadoem));
    }

    public function setCriadoEm($criadoem): void {
        $this->criadoem = $criadoem;
    }
}

