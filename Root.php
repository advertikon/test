<?php

class Root extends Node {
    /** @var DataFeederInterface */
    private $feeder;

	public function setFeeder( DataFeederInterface $feeder ) {
	    $this->feeder = $feeder;
    }

    /**
     * @throws ErrorException
     */
    public function show() {
        if ( !$this->children ) {
            if ( is_null($this->feeder ) ) {
                throw new ErrorException( "Data Feeder is missing" );
            }

            $this->buildTree( $this->feeder->feed(), $this->level );
        }

        $this->render();
    }
}