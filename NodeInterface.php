<?php


interface NodeInterface {
    public function getId(): int;
    public function getParent(): ?int;
    public function getName(): string;
    public function buildTree( array $data, $level );
    public function render();
    public function getLevel(): int;
    public function setLevel(int $level);
}