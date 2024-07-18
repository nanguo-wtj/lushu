<?php

class quotation
{

    public int $key_id = 0;

    /**
     *  项目  获取项目行程报价
     * @return array
     */
    public function quotation():array
    {

        $mysql_name   =   GetTableName('t_quotation_subterm',$this->key_id);
        $list   =   Get_data_listall(['project_id'=>$this->key_id,'type'=>5],'*',$mysql_name,'id asc');
        $code   =  [];

        if(!$list){
            $code[]   =   $this->Addquotation($this->key_id,$mysql_name);
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

        return $code;
    }
    /**
     *  项目  获取项目行程报价
     * @return array
     */
    public function supplement(){

        $mysql_name   =   GetTableName('t_quotation_subterm',$this->key_id);
        $details   =   Get_details_whereno(['project_id'=>$this->key_id,'type'=>4],'*',$mysql_name);
        if(!$details){
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $this->key_id,
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

        return $code;
    }
    /**
     *  项目  获取项目费用说明
     * @return array
     */
    public function Const():array{

        $mysql_name   =   GetTableName('t_quotation_subterm',$this->key_id);
        $list   =   Get_data_listall(['project_id'=>$this->key_id,'type'=>1],'*',$mysql_name,'id asc');
        $code   =  [];

        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return  $code;
    }
    /**
     *  项目  获取可选付费项目
     * @return array
     */
    public function PaidItems():array
    {

        $mysql_name   =   GetTableName('t_quotation_subterm',$this->key_id);
        $list   =   Get_data_listall(['project_id'=>$this->key_id,'type'=>3],'*',$mysql_name,'id asc');
        $code   =  [];

        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return $code;
    }
    /**
     *  项目  获取项目费用不包括
     * @return array
     */
    public function NotIncluded(){

        $mysql_name   =   GetTableName('t_quotation_subterm',$this->key_id);
        $list   =   Get_data_listall(['project_id'=>$this->key_id,'type'=>2],'*',$mysql_name,'id asc');
        $code   =  [];
        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return $code;
    }





    public function GetQuotation($data  =   array()):string{
        $str    =   '';
        foreach ($data as $item){
            $str    .=   "<div class=\"editQuote__headerContainer___3B5EZ\">
										<div class=\"editQuote__headerRow___9_PxR\">
											<div class=\"editQuote__totalPrice___2W7Ue\">
												<span class=\"editQuote__priceTitle___2yZ1U\">".$item['class_type']."行程报价：
												</span>
												<div class=\"editQuote__price___2uIIZ editQuote__edit___3FmJ2\">
                                                    <span class=\"editQuote__currency___1j9Ql\">(货币: 人民币)</span>
                                                </div>
											</div>
										</div>
										<div class=\"tripPriceTable__priceTable___3mNyy\">
											<div class=\"tosProjectCssMarker dataTable__dataTableSet___3xooO\">
												<div class=\"dataTable__dataTable___3z9Jt\">
													<table>
														<thead>
														<tr>
															<th style=\"line-height: 25px\">
																<div style=\"margin-right:20px;width:auto;text-align: right;\">出行日期</div>
																<div style=\"width: auto;text-align: left;margin-left: 20px;\">游客分类</div>
															</th>";
            if(in_array(1,$item['class_view'])){$str    .=   "<th>成人</th>";}
            if(in_array(2,$item['class_view'])){$str    .=   "<th>老人</th>";}
            if(in_array(3,$item['class_view'])){$str    .=   "<th>儿童</th>";}
            if(in_array(4,$item['class_view'])){$str    .=   "<th>婴儿</th>";}

            $str    .=  "
														</tr>
														</thead>
														<tbody>
														";
            foreach ($item['content'] as $a){

                $str    .=  "
														<tr>
															<td>".$a->title."</td>
															";
                    if(in_array(1,$item['class_view'])){$str    .=   "<td>".$a->adult."</td>";}
                    if(in_array(2,$item['class_view'])){$str    .=   "<td>".$a->old."</td>";}
                    if(in_array(3,$item['class_view'])){$str    .=   "<td>".$a->children."</td>";}
                    if(in_array(4,$item['class_view'])){$str    .=   "<td>".$a->baby."</td>";}
                $str    .= 								"</tr>";
            }


            $str    .=  "
														</tbody>
													</table>

												</div>
											</div>
										</div>
									</div>";
        }

        return $str;

    }

    public function GetIllustrate($data    =   array()):string{
        $str    =   '';
        foreach ($data as $item){
            $str    .=  "<div class=\"editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B\">
                            <span style=\"    width: 100px;display: inline-block;\">".$item['title']."</span>
                            <span>".$item['content']."</span>
                         </div>";
        }
        return  $str;
    }

    public function GetNotIncluded($data    =   array()):string{
        $str    =   '';
        foreach ($data as $item){
            $str    .=  "<div class=\"editQuote__dataRow___2zh0l editQuote__onlyOneColumn___2keCS\">
                            <div class=\"editQuote__column___2B62e editQuote__descriptionOnlyOne___2Vy2L\">
                            ".$item['content']."
                            </div>
                        </div>";
        }
        return  $str;
    }

    public function GetPaidItems($data    =   array()):string{
        $str    =   '';
        foreach ($data as $item){
            $str    .=  "<div class=\"editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B\">
                            <div class=\"editQuote__column___2B62e editQuote__name___3V3Tn\">
                                ".$item['title']."
                            </div>
                            <div class=\"editQuote__column___2B62e editQuote__description___2x8mR\">".$item['content']."</div>
                         </div>";
        }
        return  $str;
    }




}
