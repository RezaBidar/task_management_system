<?php
class My_Table {
    
    public function getView($thead, $tbody, $id_cel, $data , $update_url = NULL , $delete_url = NULL, $select_url = NULL ){
    
    
        $msg = "<thead>";
        $msg .= "<tr>";
        $msg .= "<td>ردیف</td>";
        foreach ($thead as $td){
            $msg .= "<td>" . $td . "</td>";
        }
        if($select_url != NULL)
            $msg .= "<td>انتخاب</td>";
        if($update_url != NULL)
            $msg .= "<td>ویرایش</td>";
        if($delete_url != NULL)
            $msg .= "<td>حذف</td>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";
    
        foreach ($data as $tr => $td){
            $msg .= "<tr>";
            $msg .= "<td>".$tr."</td>";
            foreach ($tbody as $cell_name)
                $msg .= "<td>".$td->{$cell_name}."</td>";
            if($select_url != NULL)
                $msg .= "<td><a href=\"". site_url($select_url . '/' . $td->{$id_cel}) ."\" class=\"glyphicon glyphicon-new-window \" ></a></td>";
            if($update_url != NULL)
                $msg .= "<td><a href=\"". site_url($update_url . '/' . $td->{$id_cel}) ."\" class=\"glyphicon glyphicon-edit \" ></a></td>";
            if($delete_url != NULL)
                $msg .= "<td><a href=\"". site_url($delete_url . '/' . $td->{$id_cel}) ."\" onclick=\"return confirm('are you sure ?'); \" class=\"glyphicon glyphicon-remove \" ></a></td>";
            $msg .= "</tr>";
        }
    
        $msg .= "</tbody>";
        return $msg;
    }
}