<?php
namespace Placestart;

class ComponentUtils {
	private static $groups = [ 
		"placestart" => [ 
			"ID" => "placestart",
			"NAME" => "PLACESTART"
		],
		"pages" => [ 
			"ID" => "pages",
			"NAME" => "Шаблоны страниц"
		]
	];

	public static function getComponentDescription( $name, $id, $group = "placestart" ) {
		return [ 
			"NAME" => $name,
			"DESCRIPTION" => $name,
			"PATH" => self::$groups[ $group ],
		];
	}
}
?>