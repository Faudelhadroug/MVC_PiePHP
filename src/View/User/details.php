<h2> détails </h2>
<a href='/github/MVC_PiePHP/user/index'><button> Index </button></a>
<br>
<?php
    echo '<br>';
    echo "email : $UserModel->email";
    echo '<br>';
    echo $UserModel->articles[0]->content;
    echo '<br>';
    echo $UserModel->promos->year;
    echo '<br>';
    echo $UserModel->colors[0]->name;
    echo '<br>';

