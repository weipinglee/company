<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/30
 * Time: 21:36
 */
namespace Library;
class excel{

    private $dir = 'upload/excel';

    public function getExcelData(){

        //��ȡ�ϴ��ļ�
        $file = $this->upload();
        if(is_array($file)){
            return $file;
        }
        require 'PHPExcel/PHPExcel.php';
        require 'PHPExcel/PHPExcel/Reader/Excel2007.php';

        $PHPExcel = new \PHPExcel();
        $PHPReader=new \PHPExcel_Reader_Excel2007();
        $PHPExcel=$PHPReader->load($file);

        $currentSheet=$PHPExcel->getSheet(0);
        //��ȡ������
        $allColumn=$currentSheet->getHighestColumn();
        //��ȡ������
        $allRow=$currentSheet->getHighestRow();
        //ѭ����ȡ���е����ݣ�$currentRow��ʾ��ǰ�У������п�ʼ��ȡ���ݣ�����ֵ��0��ʼ
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            //�����п�ʼ��A��ʾ��һ��
            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                //��������
                $address=$currentColumn.$currentRow;
                //��ȡ�������ݣ����浽����$arr��
                $arr[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
            }

        }

        return $arr;
    }

    /**
     * ͼƬ�ϴ�
     * @param boolean $isForge �Ƿ�α�������ύ
     */
    public function upload(){
        //ͼƬ�ϴ�
        $upObj = new upload(2048,array('xlsx','xls'));

        $upObj->setDir($this->hashDir());
        $upState = $upObj->execute();
        //����ϴ�״̬
        foreach($upState as $key => $rs)
        {
            if(count($_FILES[$key]['name']) > 1)
                return tool::getSuccInfo(0,'�ļ������ܴ���1');


            foreach($rs as $innerKey => $val)
            {
                if($val['flag']==1)
                {
                    //�ϴ��ɹ���ͼƬ��Ϣ
                    $fileName = $val['dir'].$val['name'];
                    $rs[$innerKey]['name'] = $val['name'];

                }
                else{
                    return tool::getSuccInfo(0,$rs[$innerKey]['errInfo'] = upload::errorMessage($val['flag']));
                }


               $photoArray[$key] = $rs[0];

            }
        }
        return $photoArray['no']['fileSrc'];

    }


    /**
     * @brief ��ȡͼƬɢ��Ŀ¼
     * @return string
     */
    private  function hashDir()
    {
        $dir = $this->dir.'/'.date('Y/m/d');
        return $dir;
    }
}