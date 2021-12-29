<?php
/**
 * Wrappers class for Wordpress role and its capabilities.
 */

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Traits\Theme\Hooks;

class Role {
	use Hooks;

	/**
	 * Array containing Wordpress role objects.
	 * @var \WP_Role[]
	 */
	private $roles;

	/**
	 * Array of role name(s)
	 *
	 * @param string[] $names
	 */
	public function __construct( $names ) {
		$this->roles = static::getMany( $names );
	}

	/**
	 * Returns Wordpress role objects.
	 *
	 * @return \WP_Role[]
	 */
	public function getWpRoleObjects() {
		return $this->roles;
	}

	/**
	 * Return array of role object for given role names.
	 * Associative array is return mapping role_name => WP_Role_object
	 *
	 * @param string[] $names
	 *
	 * @return \WP_Role[]
	 */
	public static function getMany( $names ) {
		$roles = [];

		foreach ( $names as $name ) {
			$roles[ $name ] = get_role( $name );
		}

		return $roles;
	}

	/**
	 * Adds new role if it does not already exist. 
	 * If display name is not provided one will be generated using $name variable.
	 * e.g. custom_role -> Custom Role
	 *
	 * @param string $name
	 * @param string $displayName
	 * @param bool[] $capabilities
	 *
	 * @return void
	 */
	public static function add( $name, $displayName = null, $capabilities = [] ) {
		add_action( 'after_switch_theme', function() use ( $name, $displayName, $capabilities ) {
			$displayName = $displayName ?: $this->getRoleDisplayName( $name );

			add_role( $name, $displayName, $capabilities );
		} );
	}

	/**
	 * Removes roles provided.
	 *
	 * @return void
	 */
	public function remove() {
		$this->afterThemeSwitchedAction( function() {
			foreach ( $this->roles as $role ) {
				remove_role( $role->name );
			}
		} );
	}

	/**
	 * Returns display name from $name variable by splitting string by _ and making each
	 * word uppercase.
	 * e.g. custom_role -> Custom Role
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	private function getRoleDisplayName( $name ) {
		return implode( ' ', array_map( 'ucwords', explode( '_', $name ) ) );
	}

	/**
	 * Adds new capability and assigns it to roles provided.
	 *
	 * @param string $capName
	 *
	 * @return Role
	 */
	public function attachCap( $capName ) {
		$this->afterThemeSwitchedAction( function() use ( $capName ) {
			foreach ( $this->roles as $role ) {
				$role->add_cap( $capName );
			}
		} );

		return $this;
	}

	/**
	 * Removes specific capability from roles provided.
	 *
	 * @param string $capName
	 *
	 * @return Role
	 */
	public function detachCap( $capName ) {
		$this->afterThemeSwitchedAction( function() use ( $capName ) {
			foreach ( $this->roles as $role ) {
				$role->remove_cap( $capName );
			}
		} );

		return $this;
	}
}
