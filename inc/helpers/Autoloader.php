<?php
/**
 * Autoloader class for theme dependencies.
 */

namespace Demo\Inc\Helpers;

class Autoloader {
	/*
	 * Root of resource namespace. Preferably theme name.
	 */
	private $namespaceRoot;

	/*
	 * Directory where all subdirectories with their resources will live.
	 */
	private $topLevelDir;

	/*
	 * Subdirectories which you want to include in autoloading.
	 */
	private $autoloadDirectories;

	/*
	 * Resource being autoloaded.
	 */
	private $resource;

	/*
	 * Full path to resource being autoloaded.
	 */
	private $resourcePath = false;

	public function __construct(
		$namespaceRoot,
		$topLevelDir = 'inc',
		$autoloadDirectories = [ 'classes', ]
	) {
		$this->namespaceRoot       = $namespaceRoot;
		$this->topLevelDir         = $topLevelDir;
		$this->autoloadDirectories = $autoloadDirectories;
	}

	public function registerAutoloader() {
		spl_autoload_register( [ $this, 'autoload' ] );
	}

	/*
	 * Autoload callback
	 */
	private function autoload( $resource = '' ) {
		$this->resource = trim( $resource, '\\' );

		if ( $this->resourceReadyForAutoload() ) {
			require_once( $this->resourcePath );
		}
	}

	/*
	 * If all required checks are passed this function will return true and let resource be autoloaded.
	 */
	private function resourceReadyForAutoload() {
		if (
			$this->isResourceInNamespace() &&
			$this->generateResourcePath() &&
			$this->isResourceValidAndExists()
		) {
			return true;
		} else {
			return false;
		}
	}

	/*
	 * Check if resource trying to get autoloaded is in your namespace.
	 */
	private function isResourceInNamespace() {
		if (
			empty( $this->resource ) ||
			strpos( $this->resource, '\\' ) === false ||
			strpos( $this->resource, $this->namespaceRoot ) !== 0
		) {
			return false;
		} else {
			return true;
		}
	}

	/*
	* Generating resource path which is stored in $resourcePath variable.
    * Will return false if subdirectory is not in your autoload directory or resource has invalid path structure.
	*/
	private function generateResourcePath() {
		$pathParts = $this->getResourcePathPartsWithoutNamespaceRoot();
		$dir       = '';
		$fileName  = '';

		/*
		 * If resource path (after stripping namespace root) is not starting with
		 * directory where all our autoloaded files reside(top level directory) return false.
		 */
		if ( $this->topLevelDir !== $pathParts[0] || empty( $pathParts[1] )
		) {
			return false;
		}

		foreach ( $this->autoloadDirectories as $autoloadDirectory ) {
			if ( $pathParts[1] === $autoloadDirectory ) {
				$dir      = $pathParts[1];
				$fileName = trim( $pathParts[2] );
				break;
			}
		}
		$this->resourcePath = sprintf(
			"%s/$this->topLevelDir/%s/%s.php",
			DEMO_DIR_PATH,
			$dir,
			$fileName
		);

		if ( empty( $dir ) || empty( $fileName ) ) {
			return false;
		} else {
			return true;
		}
	}

	/*
	* Get path parts of the resource in form of an array without namespace root.
	*/
	private function getResourcePathPartsWithoutNamespaceRoot() {
		$this->resource = str_replace( $this->namespaceRoot, '', $this->resource );

		return explode( '\\', strtolower( $this->resource ) );
	}

	/*
	 * Check if resource file actually exists and is a valid file.
	 */
	private function isResourceValidAndExists() {
		/*
		 * If the file is valid 0 is returned,
		 * also 2 is returned if file is valid but file path contains Windows drive path
		 */
		$isValidFile = validate_file( $this->resourcePath );

		if (
			! empty( $this->resourcePath ) &&
			file_exists( $this->resourcePath ) &&
			(
				0 === $isValidFile ||
				2 === $isValidFile
			)
		) {
			return true;
		} else {
			return false;
		}
	}
}

