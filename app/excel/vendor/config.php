<?php

$route= array(
    'app\excel\controller\categoriectr;voircat'   => "/cat/(?'id_cat'[^/]+)", // /cat/12 ; id_cat=12
    'app\ecom\controller\produitctr;voirprod'   => "/produit/(?'id_prod'[^/]+)",
    'app\excel\controller\view;index'      => "/"
);

return array(
"route"=>$route,
);
?>
