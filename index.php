<?php
/*error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);*/
require 'vezafull.php';
define('RB_ROOT', dirname(__FILE__));


$users = $db->get('komitenti');
var_dump($db->count);

/**
 * Instaliraj VUE plug in
 * https://www.jetbrains.com/help/phpstorm/vue-js.html
 *
 * dodaj ADDON
 * https://addons.mozilla.org/en-US/firefox/addon/vue-js-devtools/?src=search
 *
 * NIKOLA NAPRAVI SCSS kod sebe
 */



?>



<div id="root">
    <input type="text" v-model="message">
    <p>vrednost {{ message }}</p>
</div>


<script src="js/vue.js"></script>
<script>

    new Vue({
        el: "#root",
        data : {
            message : 'Hello World'
        }

    })
</script>
