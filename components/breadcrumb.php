<?php
$breadcrumbs = array();
function addBreadcrumb($title, $url = null)
{
    global $breadcrumbs;
    $breadcrumbs[] = array('title' => $title, 'url' => $url);
}

function displayBreadcrumbs()
{
    global $breadcrumbs;
    $layout = <<<HTML
            <div class="row">
                <div class="col">
                    <nav id="breadcrump-nav" aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
    HTML;
    foreach ($breadcrumbs as $index => $breadcrumb) {
        if ($breadcrumb['url']) {
            $layout .= '<li class="breadcrumb-item"><a href="' . $breadcrumb['url'] . '">' . $breadcrumb['title'] . '</a></li>';
        } else {
            $layout .= '<li class="breadcrumb-item active" aria-current="page">' . $breadcrumb['title'] . '</li>';
        }
    }
    $layout .= "</ol></nav></div></div>";

    return $layout;
}
