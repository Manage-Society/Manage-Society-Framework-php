<?php

$route= array(
    'app\workflow\controller\dossierctr;data_dossier'   => "/voirdossier/(?'id_dossier'[^/]+)", // /cat/12 ; id_cat=12
    'app\workflow\controller\dossierctr;voirdossier'   => "/dossier/(?'id_dossier'[^/]+)",
    'app\workflow\controller\view;index'      => "/",
    'app\workflow\controller\view;index'      => "/index.php"
);

return array(
"route"=>$route,
);
?>
