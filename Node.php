<?php

class Node implements NodeInterface {
    const PADDING = '-';
    const NEW_LINE = PHP_EOL;

    protected $id;
    protected $name;
    protected $parent;
    protected $children = [];
    protected $level = 0;

    public function __construct( array $data = null ) {
        $this->id = $data[0] ?? 0;
        $this->parent = $data[1] ?? null;
        $this->name = $data[2] ?? '';
    }

    /**
     * @return mixed
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getParent(): ?int {
        return $this->parent;
    }

    /**
     * @return int
     */
    public function getLevel(): int {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level) {
        $this->level = $level;
    }

    /**
     * @param NodeInterface[] $data
     * @param $level
     */
    public function buildTree( array $data, $level ) {
        foreach( $data as $node ) {
            if ( $node->getParent() === $this->getId() ) {
                $this->children[] = $node;
                $node->setLevel( $level );
                $node->buildTree( $data, $level + 1 );
            }
        }
    }

    public function render() {
        echo str_repeat( self::PADDING, $this->getLevel() ) . $this->getName() . self::NEW_LINE;

        foreach( $this->children as $child ) {
            $child->render();
        }
    }
}