<?


/**
 * 权限判断
 * $Unrestricted     不受限接口地址
 * $constrained      需要登录的接口
 * @param mixed $url string 提交的接口地址
 * @return bool
 */
function Verify_Permissions($url    =   ''):bool
{
    $Unrestricted   =   array('login','register','share','open_view');
    $constrained    =   array(
        'index','project','home','staging_project','staging_trip','resources','resources_poi','resources_picture','resources_note',
        'resources_hotel','resources_traffic','resources_activities','resources_city','resources_trip','resources_poi_details',
        'resources_poi_material','resources_poi_template','resources_picture_details','resources_note_details','resources_hotel_details',
        'resources_hotel_material','resources_hotel_template','resources_city_details','resources_trip_details','project_demand','project_trip',
        'project_cost','project_quotation','project_edit','project_edit_day','information','organization','project_edit_notes','project_cost_edit',
        'project_quotation_edit','project_quotations','project_pdf','staging_project_export','resources_activities_details','project_edit_export',
        'project_edit_day_export','project_edit_notes_export','project_cost_edit_export','project_quotation_edit_export','tag_library','recyclebin',
        'recovery','Itinerary_view','Itinerary_pdf_view','project_pdf_view'
    );
    $array_list =   array_merge($Unrestricted,$constrained);

    if(!in_array($url,$array_list)){
        return false;
    }
    if(in_array($url,$constrained)){
        Get_User_status();
    }

    return  true;
}
/**
 * 选中状态选择
 * @param mixed $cmd string 提交的接口地址
 * @return string
 */
function Get_Menu_Status($cmd   =   '',$key =   'index'):string
{
    $str    =   '';
    $index  =   array('index');
    $project    =   array('project','staging_project','project_demand','project_trip','project_cost','project_quotation','recovery');
    $resources    =   array('resources','resources_poi','resources_picture','resources_note','resources_hotel','resources_traffic',
        'resources_activities','resources_city','resources_trip','resources_poi_details','resources_poi_material','resources_poi_template',
        'resources_picture_details','resources_note_details','resources_hotel_details','resources_city_details','resources_trip_details','resources_activities_details','staging_project_export'
        );
    $home   =   array('home');
    $information   =   array('information');
    if(in_array($cmd,$$key)){
        $str    =   'layoutSide__active___1nyoZ';
    }
    return $str;
}

/**
 * 返回当前时间前7天时间
 * @return array
 */
function GetDay7():array
{
    $time = time();
    $Day    =   [];
    for ($i=6;$i>=1;$i--){
        $Day[]  =   date('Y-m-d',($time-(86400*$i)-1));
    }
    $Day[]    =   date('Y-m-d',$time);

    return  $Day;
}