<?php

if (file_exists(dirname(__FILE__) . '/../config.inc.php')) {
    require_once dirname(__FILE__) . '/../config.inc.php';
} else {
    require_once dirname(__FILE__) . '/../config.sample.php';
}

$annotation = new UNL_Annotate();

$outputcontroller = new UNL_Annotate_OutputController();
$outputcontroller->setTemplatePath(dirname(__FILE__).'/templates/json');

if ($annotation->options['format'] != 'json') {
    switch($annotation->options['format']) {
        case 'partial':
            Savvy_ClassToTemplateannotationper::$output_template['UNL_Annotate'] = 'UNL/Annotate-partial';
            break;
        case 'html':
            header('Content-type:text/html;charset=UTF-8');
            break;
        default:
            header('Content-type:text/html;charset=UTF-8');
    }
    $outputcontroller->addTemplatePath(dirname(__FILE__).'/templates/'.$annotation->options['format']);
}

$outputcontroller->setEscape('htmlentities');

echo $outputcontroller->render($annotation);