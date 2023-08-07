<?php
class Model {

    public $text;



    public function __construct() {

        $this->text = 'Hello world!';

    }

}





// class View {

//     private $model;



//     public function __construct(Model $model) {

//         $this->model = $model;

//     }



//     public function output() {

//         return '<h1>' . $this->model->text .'</h1>';

//     }



// }


class View {

    private $model;



    public function __construct(Model $model) {

        $this->model = $model;

    }



    public function output() {

        return '<a href="mvc.php?action=textclicked">' . $this->model->text . '</a>';

    }

}

// class Controller {

//     private $model;



//     public function __construct(Model $model) {

//         $this->model = $model;

//     }

// }


class Controller {

    private $model;



    public function __construct(Model $model) {

        $this->model = $model;

    }



    public function textClicked() {

        $this->model->text = 'Text Updated';

    }

}






//initiate the triad

// $model = new Model();

// //It is important that the controller and the view share the model

// $controller = new Controller($model);

// $view = new View($model);

// echo $view->output();


$model = new Model();

//It is important that the controller and the view share the model

$controller = new Controller($model);

$view = new View($model);

if (isset($_GET['action'])) $controller->{$_GET['action']}();

echo $view->output();
?>