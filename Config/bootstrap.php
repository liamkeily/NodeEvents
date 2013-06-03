<?php

Croogo::hookComponent('Nodes', array('NodeEvents.NodeEvent'=>array('priority' => 8)));

Croogo::hookBehavior('Node', 'NodeEvents.NodeEvent', array());

