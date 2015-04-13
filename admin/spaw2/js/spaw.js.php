<?php

header( 'Content-Type: application/x-javascript' );

require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/../config/config.php' );
require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/../class/util.class.php' );

$spaw_root = SpawConfig::getStaticConfigValue( "SPAW_ROOT" );
$agent = SpawAgent::getAgentName();

if ( is_dir($spaw_root . 'js/common') )
{
	if ( $dh = opendir($spaw_root . 'js/common') )
	{
		while ( ($fn = readdir($dh)) !== false )
		{
			if ( $fn != '.' && $fn != '..' && ! is_dir($spaw_root . 'js/common/' . $fn) ) include ( $spaw_root . 'js/common/' . $fn );
		}
		closedir( $dh );
	}
}

if ( is_dir($spaw_root . 'js/' . $agent) )
{
	if ( $dh = opendir($spaw_root . 'js/' . $agent) )
	{
		while ( ($fn = readdir($dh)) !== false )
		{
			if ( $fn != '.' && $fn != '..' && ! is_dir($spaw_root . 'js/' . $agent . '/' . $fn) ) include ( $spaw_root . 'js/' . $agent . '/' . $fn );
		}
		closedir( $dh );
	}
}

$pgdir = $spaw_root . 'plugins/';
if ( is_dir($pgdir) )
{
	if ( $dh = opendir($pgdir) )
	{
		while ( ($pg = readdir($dh)) != false )
		{
			if ( $pg != '.' && $pg != '..' )
			{

				if ( is_dir($pgdir . $pg . '/js/common') )
				{
					if ( $pgdh = opendir($pgdir . $pg . '/js/common') )
					{
						while ( ($fn = readdir($pgdh)) !== false )
						{
							if ( $fn != '.' && $fn != '..' && ! is_dir($pgdir . $pg . '/js/common/' . $fn) ) include ( $pgdir . $pg . '/js/common/' . $fn );
						}
						closedir( $pgdh );
					}
				}

				if ( is_dir($pgdir . $pg . '/js/' . $agent) )
				{
					if ( $pgdh = opendir($pgdir . $pg . '/js/' . $agent) )
					{
						while ( ($fn = readdir($pgdh)) !== false )
						{
							if ( $fn != '.' && $fn != '..' && ! is_dir($pgdir . $pg . '/js/' . $agent . '/' . $fn) ) include ( $pgdir . $pg . '/js/' . $agent . '/' . $fn );
						}
						closedir( $pgdh );
					}
				}

				if ( is_dir($pgdir . $pg . '/lib/theme') )
				{
					if ( $tdh = opendir($pgdir . $pg . '/lib/theme') )
					{
						while ( ($th = readdir($tdh)) != false )
						{
							if ( $th != '.' && $th != '..' )
							{

								if ( is_dir($pgdir . $pg . '/lib/theme/' . $th . '/js/common') )
								{
									if ( $thdh = opendir($pgdir . $pg . '/lib/theme/' . $th . '/js/common') )
									{
										while ( ($fn = readdir($thdh)) !== false )
										{
											if ( $fn != '.' && $fn != '..' && ! is_dir($pgdir . $pg . '/lib/theme/' . $th . '/js/common/' . $fn) ) include ( $pgdir . $pg . '/lib/theme/' . $th . '/js/common/' . $fn );
										}
										closedir( $thdh );
									}
								}

								if ( is_dir($pgdir . $pg . '/lib/theme/' . $th . '/js/' . $agent) )
								{
									if ( $thdh = opendir($pgdir . $pg . '/lib/theme/' . $th . '/js/' . $agent) )
									{
										while ( ($fn = readdir($thdh)) !== false )
										{
											if ( $fn != '.' && $fn != '..' && ! is_dir($pgdir . $pg . '/lib/theme/' . $th . '/js/' . $agent . '/' . $fn) ) include ( $pgdir . $pg . '/lib/theme/' . $th . '/js/' . $agent . '/' . $fn );
										}
										closedir( $thdh );
									}
								}
							}
						}
					}
				}

			}
		}
		closedir( $dh );
	}
}

?>