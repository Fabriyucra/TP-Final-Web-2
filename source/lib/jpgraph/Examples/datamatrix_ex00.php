<?php
require_once('jpgraph/datamatrix/datamatrix.link.php');

$data = 'The first datamatrix';

$encoder = DatamatrixFactory::Create();
$backend = DatamatrixBackendFactory::Create($encoder);
$backend->Stroke($data);
?>
