<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        'timeout' => false,
        'options' => array(
            'outline'           => true,
            'footer-center'     => 'foobar HERE &copy; ' . date('Y'),
            'footer-right'      => 'Pag. [page] de [toPage]'

        ),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('vendor\h4cc\wkhtmltoimage-amd64\bin\wkhtmltoimage-amd64'),
        'timeout' => false,
        'options' => array(
            
        ),
    ),


);
