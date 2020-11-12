<?php

/**
 * 
 */
class FileDataFeeder implements DataFeederInterface {
    const ROW_SEPARATOR  = PHP_EOL;
    const LINE_SEPARATOR = '|';
    const ITEMS_COUNT    = 3;

	private $fileName;

	function __construct( string $fileName ) {
		$this->fileName = $fileName;
	}

    /**
     * @return NodeInterface[]
     * @throws ErrorException
     */
	public function feed(): array {
	    if ( !file_exists( $this->fileName ) ) {
	        throw new ErrorException( "File {$this->fileName} does not exist" );
        }

	    $content = file_get_contents( $this->fileName );

	    if ( false === $content ) {
            throw new ErrorException( "Failed to read file {$this->fileName}" );
        }

	    $data = [];

	    foreach( explode( self::ROW_SEPARATOR, $content ) as $row ) {
	        if ( !trim( $row ) ) {
	            continue;
            }

	        $items = explode( self::LINE_SEPARATOR, $row );

	        if ( count( $items ) < self::ITEMS_COUNT ) {
	            throw new ErrorException( "Invalid data format" );
            }

	        $data[] = new Node( $items );
        }

	    return $data;
    }
}