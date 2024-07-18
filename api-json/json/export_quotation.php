<?php

class   export_quotation
{



    /**
     *  项目  获取项目行程报价分类
     * @return string
     * @throws Exception
     */
    public function quotation_type():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>5],'class_type,class_view',$mysql_name);
        $code   =  [];
        $class_type =   [];
        $class_view =   [];
        $class_type_user =   [];
        foreach ($list as $item){
            $class_view =   explode(',',$item['class_view']);
            if(in_array($item['class_type'],array('经济','奢华'))){
                $class_type[]   =   $item['class_type'];
            }else{
                if($item['class_type'] !=  '标准'){
                    $class_type_user[]   =   $item['class_type'];

                }
            }
        }
        foreach ($class_view as $index=>$item){
            $class_view[$index] =   (int)$item;
        }
        $code   =   [
            'class_type'    =>  $class_type,
            'class_type_user'    =>  $class_type_user,
            'class_view'    =>  $class_view,
        ];

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  获取项目行程报价
     * @return string
     * @throws Exception
     */
    public function quotation():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>5],'*',$mysql_name,'id asc');
        $code   =  [];

        if(!$list){
            $code[]   =   $this->Addquotation($key_id,$mysql_name);
        }else{
            foreach ($list as $item){
                $code[]   =   [
                    'addtime'   =>  date('Y-m-d H:i:s',$item['addtime']),
                    'id'    =>  $item['id'],
                    'project_id'    =>  $item['project_id'],
                    'content'   =>  json_decode($item['content']),
                    'type'  =>  $item['type'],
                    'class_type'    =>  $item['class_type'],
                    'class_view'    =>  explode(',',$item['class_view']),
                ];

            }
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  根据项目key查询项目报价补充说明
     * @return string
     * @throws Exception
     */
    public function supplement():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $details   =   Get_details_whereno(['project_id'=>$key_id,'type'=>4],'*',$mysql_name);
        if(!$details){
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'content'   =>  '',
                'type'  =>  4,
            ];
            $class_id   =   add_detail($code,$mysql_name);
            $code['id'] =   $class_id;
        }else{
            $code   =   [
                'id'    =>  $details['id'],
                'project_id'    =>  $details['project_id'],
                'content'   =>  $details['content'],
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  根据项目key查询项目报价费用说明
     * @return string
     * @throws Exception
     */
    public function Const():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>1],'*',$mysql_name,'id asc');
        $code   =  [];

        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  根据项目key查询项目报价可选付费项目
     * @return string
     * @throws Exception
     */
    public function PaidItems():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>3],'*',$mysql_name,'id asc');
        $code   =  [];

        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  根据项目key查询项目报价费用不包括
     * @return string
     * @throws Exception
     */
    public function NotIncluded():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>2],'*',$mysql_name,'id asc');
        $code   =  [];
        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  根据项目key查询项目报价费用不包括
     * @return string
     * @throws Exception
     */
    public function classification():string{
        $key_id     =   req('key_id');
        $code     =   req('code');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);

        if(!isset($code['classification'])){$code['classification'] =   [];}
        if(!isset($code['grading'])){$code['grading'] =   [];}
        if(!isset($code['grading_user'])){$code['grading_user'] =   [];}

        $classification =   $code['classification'];
        $grading    =   $code['grading'];
        $grading_user    =   $code['grading_user'];




        $grading_list   =   array_merge($grading,$grading_user);
        $grading_list   =   array_unique($grading_list);



        $classification_id  =   [1];
        foreach ($classification as $item){
            switch ($item){
                case '老人':
                    $classification_id[]    =   2;
                    break;
                case '儿童':
                    $classification_id[]    =   3;
                    break;
                case '婴儿':
                    $classification_id[]    =   4;
                    break;
            }
        }
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>5],'id,class_type,class_view',$mysql_name);
        $In_grading =   [];
        $class_view =   '';
        foreach ($list as $item){
            if(!in_array($item['class_type'],$grading_list) && $item['class_type'] != '标准'){
                Del_where(['id'=>$item['id']],$mysql_name);
            }else{
                $In_grading[]   =   $item['class_type'];
            }
            $class_view =   $item['class_view'];
        }
        sort($classification_id);
        $classification_id  =   implode(',',$classification_id);
        if($classification_id != $class_view){
            updata_detail_all("class_view =  '".$classification_id."'",$mysql_name,['project_id'=>$key_id,'type'=>5]);
        }

        foreach ($grading_list as $index=>$item){
            if(in_array($item,$In_grading)){
                unset($grading_list[$index]);
            }
        }

        foreach ($grading_list as $item){
            $content    =   [
                [
                    'title'     =>      '平时价格',
                    'adult'     =>      '',
                    'old'       =>      '',
                    'children'      =>      '',
                    'baby'      =>      '',
                ]
            ];
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'content'   =>  json_encode($content,JSON_UNESCAPED_UNICODE),
                'type'  =>  5,
                'class_type'    =>  $item,
                'class_view'    =>  $classification_id,
            ];
            $class_id   =   add_detail($code,$mysql_name);
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目  修改行程报价
     * @return string
     * @throws Exception
     */
    public function setTime():string{
        $key_id     =   req('key_id');
        $key     =   req('key');
        $data     =   req('data');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
            [$data,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);

        updata_detail(['content'=>json_encode($data,JSON_UNESCAPED_UNICODE)],$mysql_name,$key);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目  添加编辑项目报价费用说明
     * @return string
     * @throws Exception
     */
    public function setConst():string{
        $key_id     =   req('key_id');
        $data     =   req('data');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$data,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key     =   $data['id'];
        $title     =   $data['title'];
        $content     =   $data['content'];
        $verification   =   [
            [$title,code::PARAMETER_ERROR,'required'],
            [$content,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);

        if($key){
            updata_detail(['title'=>$title,'content'=>$content],$mysql_name,$key);
        }else{
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'title'   =>  $title,
                'content'   =>  $content,
                'type'  =>  1,
            ];
            $key   =   add_detail($code,$mysql_name);
        }
        $value   =   [
            'id'    =>  $key,
            'title'    =>  $title,
            'content'   =>  $content,
            'status'  =>  false,
        ];
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$value],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  添加编辑项目报价补充说明
     * @return string
     * @throws Exception
     */
    public function setsupplement():string{
        $key_id     =   req('key_id');
        $data     =   req('data');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$data,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key     =   $data['id'];
        $content     =   $data['content'];
        $verification   =   [
            [$content,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);

        if($key){
            updata_detail(['content'=>$content],$mysql_name,$key);
        }else{
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'content'   =>  $content,
                'type'  =>  4,
            ];
            $key   =   add_detail($code,$mysql_name);
        }
        $value   =   [
            'id'    =>  $key,
            'content'   =>  $content,
            'status'  =>  false,
        ];
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$value],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  添加编辑项目报价可选付费项目
     * @return string
     * @throws Exception
     */
    public function setPaidItems():string{
        $key_id     =   req('key_id');
        $data     =   req('data');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$data,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key     =   $data['id'];
        $title     =   $data['title'];
        $content     =   $data['content'];
        $verification   =   [
            [$title,code::PARAMETER_ERROR,'required'],
            [$content,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);

        if($key){
            updata_detail(['title'=>$title,'content'=>$content],$mysql_name,$key);
        }else{
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'title'   =>  $title,
                'content'   =>  $content,
                'type'  =>  3,
            ];
            $key   =   add_detail($code,$mysql_name);
        }
        $value   =   [
            'id'    =>  $key,
            'title'    =>  $title,
            'content'   =>  $content,
            'status'  =>  false,
        ];
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$value],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目  添加编辑项目报价费用不包括
     * @return string
     * @throws Exception
     */
    public function setNotIncluded():string{
        $key_id     =   req('key_id');
        $data     =   req('data');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$data,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key     =   $data['id'];
        $content     =   $data['content'];
        $verification   =   [
            [$content,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);

        if($key){
            updata_detail(['content'=>$content],$mysql_name,$key);
        }else{
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'content'   =>  $content,
                'type'  =>  2,
            ];
            $key   =   add_detail($code,$mysql_name);
        }
        $value   =   [
            'id'    =>  $key,
            'content'   =>  $content,
            'status'  =>  false,
        ];
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$value],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  去除项目报价补充说明
     * @return string
     * @throws Exception
     */
    public function DelQuotation():string{
        $key_id     =   req('key_id');
        $key     =   req('key');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
        Del_where(['id'=>$key],$mysql_name);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  添加默认行程报价
     * @return array
     * @throws Exception
     */
    private function Addquotation($project_id   =   0,$sql_name =   ''):array{
        $content    =   [
            [
                'title'     =>      '平时价格',
                'adult'     =>      '',
                'old'       =>      '',
                'children'      =>      '',
                'baby'      =>      '',
            ]
        ];
        $code   =   [
            'addtime'   =>  time(),
            'project_id'    =>  $project_id,
            'content'   =>  json_encode($content,JSON_UNESCAPED_UNICODE),
            'type'  =>  5,
            'class_type'    =>  '标准',
            'class_view'    =>  '1',
        ];
        $class_id   =   add_detail($code,$sql_name);
        $code['id'] =   $class_id;
        $code['content'] =   $content;
        $code['type'] =   [5];
        return  $code;
    }



}



$data       =   new export_quotation();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'quotation';
    $list_code  =   array('quotation','quotation_type','classification','setTime','Const','setConst','NotIncluded',
        'setNotIncluded','PaidItems','setPaidItems','supplement','setsupplement','DelQuotation');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}

