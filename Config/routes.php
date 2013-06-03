<?php
CroogoRouter::connect('/events', array(
	'plugin' => 'node_events', 'controller' => 'events', 'action' => 'index'
));

CroogoRouter::connect('/event/:slug', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'view',
	'type' => 'event'
));
