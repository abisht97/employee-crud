<?php
    
function deleteButtonModal($id, $text = 'Delete')
{
    $txt = '';
    $circle = 'btn-circle';
    if (!empty($text)) {
        $txt = $text;
        $circle = '';
    }
    $out = '<button type="button" class="btn btn-danger ' . $circle . '" data-bs-toggle="modal" data-bs-target="#modal_default_' . $id . '">
               <i class="fa fa-trash" title="Delete"></i> ';
    $out .= $txt;
    $out .= '</button>';
    return $out;
}

function deleteModalPost($url, $id, $nid = null)
{
    $out = '';
    $out .= '<div class="modal fade" id="modal_default_' . $id . '" tabindex="-1"><div class="modal-dialog">
            <div class="modal-content"><form method="POST" action="' . $url . '" class="prevent-multi-submits">
            <input name="_method" type="hidden" value="DELETE">';
    if ($nid) {
        $out .= '<input name = "nid" type = "hidden" value = "' . $nid . '" >';
    }
    $out .= '<input type="hidden" name="_token" value="' . csrf_token() . '" />
            <div class="modal-header"><h4 class="modal-title">Are you sure to delete this record?</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-bs-dismiss="modal">No, cancel please!</button>
                <input type="submit" class="btn btn-danger prevent-multi-submits" value="Yes, delete it!" />
            </div></form></div></div></div>';
    return $out;
}