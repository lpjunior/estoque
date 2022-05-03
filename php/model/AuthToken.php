<?php
    class AuthToken {
        private int $id;
        private int $usuarioId;
        private string $token;
        private string $ultimoAcesso;
        private string $atualizadoEm;
        private string $criadoEm;
        private string $encryptionKey;

        public function __construct() {}

        public function getId(): int {
            return $this->id;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }
        
        public function getUsuarioId(): int {
            return $this->usuarioId;
        }

        public function setUsuarioId(int $usuarioId): void {
            $this->usuarioId = $usuarioId;
        }
       
        public function getToken(): string {
            return $this->token;
        }

        public function setToken(string $token): void {
            $this->token = $token;
        }
        
        public function getUltimoAcesso(): string {
            return $this->ultimoAcesso;
        }

        public function setUltimoAcesso(string $ultimoAcesso): void {
            $this->ultimoAcesso = $ultimoAcesso;
        }
        
        public function getAtualizadoEm(): string {
            return $this->atualizadoEm;
        }

        public function setAtualizadoEm(string $atualizadoEm): void {
            $this->atualizadoEm = $atualizadoEm;
        }
        
        public function getCriadoEm(): string {
            return $this->criadoEm;
        }

        public function setCriadoEm(string $criadoEm): void {
            $this->criadoEm = $criadoEm;
        }
        
        public function getEncryptionKey(): string {
            return $this->encryptionKey;
        }

        public function setEncryptionKey(string $encryptionKey): void {
            $this->encryptionKey = $encryptionKey;
        }
    }