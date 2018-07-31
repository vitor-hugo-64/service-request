<?php

namespace SR;

use \SR\Page;

class PageAdmin extends Page
{
	
	function __construct( $opts = array( null), $directoryViews = 'views/admin/')
	{
		parent::__construct( $opts, $directoryViews);
	}
}