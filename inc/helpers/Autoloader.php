<?php
/*
 * Autoloader class for theme dependencies.
 */

namespace Demo\Inc\Helpers;

class Autoloader {
	/*
	 * Absolute path to your theme folder.
	 *
	 * You can provide it using get_template_directory() function in combination with untrailingslashit( $string )
	 * Eg. untrailingslashit( get_template_directory() )
	 */
	private $themeDir;

	/*
	 * Root of resource namespace. Preferably theme name.
	 *
	 * This is the namespace root you will use for all your resources which you want to autolaod.
	 */
	private $namespaceRoot;

	/*
	 * Directory where all subdirectories with their resources will live.
	 */
	private $topLevelDir;

	/*
	 * Subdirectories which you want to include in autoloading.
	 */
	private $autoloadDirs;

	/*
	 * Resource being autoloaded.
	 */
	private $resource;

	/*
	 * Full path to resource being autoloaded.
	 */
	private $resourcePath = false;

	public function __construct(
		$themeDir,
		$namespaceRoot,
		$topLevelDir = 'inc',
		$autoloadDirs = [ 'classes', ]
	) {
		$this->themeDir      = $themeDir;
		$this->namespaceRoot = $namespaceRoot;
		$this->topLevelDir   = $topLevelDir;
		$this->autoloadDirs  = $autoloadDirs;
	}

	public function register() {
		spl_autoload_register( [ $this, 'autoload' ] );
	}

	/*
	 * Autoload callback
	 */
	private function autoload( $resource = '' ) {
		$this->resource = trim( $resource, '\\' );

		if ( $this->resourceReadyForAutoload() ) {
			echo $this->resourcePath . '---';
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

		/*
		 * If resource path (after stripping namespace root) is not starting with
		 * directory where all our autoloaded files reside(top level directory)
		 * or resource is just in top level dir(not in provided subdirectories)
		 * or if directory where resource lives is not in subdirectories provided(autoload directories) return false.
		 */
		if (
			$this->topLevelDir !== $pathParts[0] ||
			empty( $pathParts[1] ) ||
			! in_array( $pathParts[1], $this->autoloadDirs )
		) {
			return false;
		}

		/*
		 * It only matters that resource is in any of our autoload directories and we autoload any resource in it
		 * regardless of structure inside autoload directories.
		 *
		 * Eg. classes/some_dir/another_dir/resource.php
		 * Eg. classes/resource.php
		 * Both will work in the same way.
		 */
		$this->resourcePath = sprintf(
			"%s/%s.php",
			$this->themeDir,
			implode( '/', $pathParts ),
		);

		return true;
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
		 * If the file is valid 0 is returned and 2 is returned if file is valid but file path contains Windows drive path
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

