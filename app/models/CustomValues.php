<?php
namespace app\models;

class CustomValues
{
    const layaout = <<<HTML
    <div class="pull-left">
        {summary}
    </div>
    <div class="pull-right">
        {toggleData}
    </div>
    <div class="clearfix"></div>
        {items}
        {pager}
HTML;
//     const layaout = <<<HTML
//     <div class="pull-left">
//         {summary}
//     </div>
//     <div class="pull-right">
//         {toggleData}
//         {export}
//     </div>
//     <div class="clearfix"></div>
//         {items}
//         {pager}
// HTML;

    function __construct(){

    }
}
