<?php

$route= array(
    'app\ecom\controller\categoriectr;voircat'   => "/cat/(?'id_cat'[^/]+)", // /cat/12 ; id_cat=12
    'app\ecom\controller\produitctr;voirprod'   => "/produit/(?'id_prod'[^/]+)",
    'app\ecom\controller\view;index'      => "/"
);

return array(
"route"=>$route,
);
?>
