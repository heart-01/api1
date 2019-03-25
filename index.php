<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require 'vendor/autoload.php';

    $app = new \Slim\App;



    $app->get('/',function(){  //สร้างฟังชั่นเรียกใช้ localhost โดยที่ไม่ต้องพิมพาธพิมพ์ localhost แล้วชื่อไฟล์ได้เลย
        echo "Hello world";
    });

    /*
        Request  คือ การร้องขอเข้ามาแล้วแสดง
        Response คือ การแสดงผล
        function คือ ตัวกลางในการเชื่อมต่อระหว่าง Request กับ Response

        ถ้าให้แสดงผลอย่างเดียวไม่ต้องใส่ Request ก็ได้
    */

    $app->get('/hello',function(Request $req, Response $res){
        $res->getBody()->write("สวัสดี");
        return $res;
    });

    $app->get('/hello/{name}',function(Request $req, Response $res){ //สร้างฟังชั่นให้แสดงผลตาม get localhost/hello/ แล้วตามด้วยชื่อ
        $name = $req->getAttribute('name');
        $res->getBody()->write("Hello, $name");
        return $res;
    });

    //มีข้อมูล array ตัวเดียว แต่สามารถใส่ รหัสสินค้าตามหลังแล้วแสดงผลได้
    $app->get('/product/{productId}',function(Request $req, Response $res){
        $product=array('id'=>$req->getAttribute('productId'), //สร้างตัวแปร product ชนิด array มีข้อมูลคล้าย json
                'name'=>'product1','price'=>1000);
        $json_res=$res->withJson($product);  //ฟังชั่นแปลง array เป็น Json
        return $json_res;
    });

    //มีข้อมูล array หลายตัว รหัสสินค้าเป็นค่าคงที่
    $app->get('/showproduct',function(Request $req, Response $res){
        $products=array(array('id'=>'10001','name'=>'Product1', 'price'=>1000),
                        array('id'=>'10002','name'=>'Product2', 'price'=>2000),
                        array('id'=>'10003','name'=>'Product3', 'price'=>3000)
        );
        $json_res=$res->withJson($products);  //ฟังชั่นแปลง array เป็น Json
        return $json_res;
    });



    $app->run(); //ให้ app รันทำงาน

?>