<?php

/**
 * 公共方法类
 *
 * @author  James
 * @date    2011-06-15 15:00
 * @version $Id$
 */
class COMMON
{
    // 页码
    private static $page = 1;
    // 每页显示记录数量
    private static $rows = 12;

    /**
     * Constructor
     *
     * @param   void
     * @return  void
     */
    public function __construct()
    {
        //construct class
    }

    /**
     * return result data
     *
     * @param   int $code 200 ok  300 failed 301 timeout
     * @param   string $msg
     * @return  string
     */
    public static function result($code, $msg = '', $exten = array())
    {
        $res = array(
            "statusCode" => $code, //"200"
            "message" => $msg,
        );
        if (is_array($exten) && count($exten) > 0)
            $res += $exten;
        echo json_encode($res);
    }

    /**
     * return result data
     *
     * @param   int $code 200 ok  300 failed 301 timeout
     * @param   string $msg
     * @return  string
     */
    public static function ApiJson($code, $msg = '', $data = [])
    {
        $res = array(
            'code' => $code, //"200"
            'message' => $msg,
        );

        if (is_array($data) && count($data) > 0) {
            $res['data'] = $data;
        } else {
            $res['data'] = (object)$data;
        }
        echo json_encode($res);
        exit();
    }

    /**
     * page number
     *
     * @param   int $val
     * @return  int
     */
    public static function P($val = null)
    {
        if (isset($_REQUEST['pageCurrent']) && is_numeric($_REQUEST['pageCurrent'])) {
            self::$page = $_REQUEST['pageCurrent'];
        } else if (null !== $val) {
            self::$page = intval($val);
        }
        return self::$page;
    }

    /**
     * rows per page
     *
     * @param   int $val
     * @return  int
     */
    public static function PR($val = null)
    {
        if (isset($_REQUEST['pageSize']) && is_numeric($_REQUEST['pageSize'])) {
            self::$rows = $_REQUEST['pageSize'];
        } else if (null !== $val) {
            self::$rows = intval($val);
        }
        return self::$rows;
    }

    /**
     * 获取ip
     */
    public static function getclientIp()
    {

        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * 随机获得编码id
     *  船入库预约A1，车入库预约B1，船出库预约D1，车出库预约C1，船入库订单A2，车入库订单B2，船出库订单D2，车出库订单C2，货权转移单T，
     *  磅码单入库A3,磅码单出库B3，盘点单CH，清库单Q，倒罐单Y，客户C, 合同S，库存记录S,
     *  费用单F，开票单K，收款单R，核销单H，
     *  部门编码D，权限P，员工E，
     */
    public static function getCodeId($prefix = '')
    {
        list($min, $sec) = explode(" ", microtime());
        // $min = substr($min,2,6);
        // $id = $prefix.$sec.$min.mt_rand(100,999);
        $min = substr($min, 2, 2);
        $id = $prefix . date("ymdHi") . $min . mt_rand(10, 99);
        return $id;
    }

    /**
     * 计算相差几天
     * #$diffday = count_days(strtotime(date("Ymd")),strtotime(SERVERSTART));
     */
    public static function count_days($a, $b)
    {
        $a_dt = getdate($a);
        $b_dt = getdate($b);
        $a_new = mktime(12, 0, 0, $a_dt['mon'], $a_dt['mday'], $a_dt['year']);
        $b_new = mktime(12, 0, 0, $b_dt['mon'], $b_dt['mday'], $b_dt['year']);
        return round(($a_new - $b_new) / 86400);
    }

    /**
     * 新建目录
     */
    public static function makeDir($folder)
    {
        $reval = false;
        if (!file_exists($folder)) {
            @umask(0);
            preg_match_all('/([^\/]*)\/?/i', $folder, $atmp);
            $base = ($atmp[0][0] == '/') ? '/' : '';
            foreach ($atmp[1] AS $val) {
                if ('' != $val) {
                    $base .= $val;
                    if ('..' == $val || '.' == $val) {
                        $base .= '/';
                        continue;
                    }
                } else {
                    continue;
                }

                $base .= '/';

//         echo $base."<br>";
                if (!file_exists($base)) {
                    if (@mkdir(rtrim($base, '/'), 0777)) {
                        @chmod($base, 0777);
                        $reval = true;
                    }
                }
            }
        } else {
            $reval = is_dir($folder);
        }

        clearstatcache();
        return $reval;
    }

    public static function getExamStatus($status = '')
    {
        switch ($status) {
            case '1':
                return '新增';
            case '2':
                return '暂存';
            case '3':
                return '待确认';
            case '4':
                return '待审核';
            case '5':
                return '已审核';
            case '6':
                return '已完成';
            case '7':
                return '退回';
            case '8':
                return '作废';
            default:
                return '新增';
        }
    }

    //车预约出库 1新建2暂存3待确认4待审核5提货中6已完成7退回
    public static function getExamBookoutCarStatus($status = '')
    {
        switch ($status) {
            case '1':
                return '新增';
            case '2':
                return '暂存';
            case '3':
                return '待确认';
            case '4':
                return '待审核';
            case '5':
                return '已审核';
            case '6':
                return '已完成';
            case '7':
                return '退回';
            case '8':
                return '作废';
            default:
                return '新增';
        }
    }

    //船出库 1新建2暂存3待审核4已完成5作废6退回
    public static function getStockOutStatus($status = '')
    {
        switch ($status) {
            case '1':
                return '新增';
            case '2':
                return '暂存';
            case '3':
                return '待审核';
            case '4':
                return '已完成';
            case '5':
                return '作废';
            default:
                return '新增';
        }
    }

    //车出库  1新建2暂存3出库中4已完成6退回
    public static function getCarStockOutStatus($status = '')
    {
        switch ($status) {
            case '1':
                return '新增';
            case '2':
                return '暂存';
            case '3':
                return '出库中';
            case '4':
                return '已完成';
            case '6':
                return '退回';
            default:
                return '新增';
        }
    }

    //开票通知单状态：1新建2暂存3待审核4已审核5作废6退回7已关闭
    public static function getInvoiceStatus($status = '')
    {
        switch ($status) {
            case '1':
                return '新增';
            case '2':
                return '暂存';
            case '3':
                return '待审核';
            case '4':
                return '已审核';
            case '5':
                return '作废';
            case '6':
                return '退回';
            case '7':
                return '已关闭';
            default:
                return '新增';
        }
    }

    /**
     * 入库单状态变更（审核）
     * @param $bookingno
     * @param $stockinqty
     * @return bool
     * @throws Exception
     */
    public static function editStockInStatus($bookingno, $stockinqty)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_instock', false);
            $data = $Web->stockinFunc($bookingno, $stockinqty);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['bookingno' => $bookingno, 'stockinqty' => $stockinqty]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            return false;
        }
//        if ($data['status'] != 'success') {
//            return false;
//        }
        return true;
    }

    /**
     * 出库单状态变更（审核）
     * @param $stockoutno 出库单号
     * @return bool
     * @throws Exception
     */
    public static function editStockOutStatus($stockoutno)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_outstock', false);
            $data = $Web->stockupFunc($stockoutno);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['stockoutno' => $stockoutno]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            return false;
        }
//        if ($data['status'] != 'success') {
//            return false;
//        }
        return true;
    }

    /**
     * 出库单状态变更及实际出库量（出库）
     * @param $stockoutno 出库单号
     * @param int $stockoutqty 出库数量
     * @return bool
     * @throws Exception
     */
    public static function editStockOutStatusOk($stockoutno, $stockoutqty)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_outstock', false);
            $data = $Web->stockoutFunc($stockoutno, $stockoutqty);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['stockoutno' => $stockoutno, 'stockoutqty' => $stockoutqty]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            return false;
        }
//        if ($data['status'] != 'success') {
//            return false;
//        }
        return true;
    }

    /**
     *    货权转移单状态变更及实际转移量（完成）
     * @param $transstockno 货权转移编号
     * @param $transqty 转移数量
     * @return bool
     * @throws Exception
     */
    public static function edittransStatus($transstockno, $transqty)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_transstock', false);
            $data = $Web->stocktransFunc($transstockno, $transqty);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['transstockno' => $transstockno, 'transqty' => $transqty]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            return false;
        }
//        if ($data['status'] != 'success') {
//            return false;
//        }
        return true;
    }

    /**
     *    入库预约驳回
     * @param $bookingno 入库预约编号
     * @param $msg 驳回意见
     * @return bool
     * @throws Exception
     */
    public static function editStockInReject($bookingno, $msg)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_Instock', false);
            $array = ['stockno' => $bookingno, 'msg' => $msg];
            $data = $Web->overruleFunc($array);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['bookingno' => $bookingno, 'msg' => $msg]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
            if ($data['status'] == 'success') {
                $result = [
                    'code' => 200,
                    'message' => $data['msg']
                ];
            } else {
                throw new Exception($data['msg'], 300);
            }
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            $result = [
                'code' => 300,
                'message' => $e->getMessage()
            ];
        }
        return $result;
    }

    /**
     *    出库预约驳回
     * @param $stockoutno 出库编号
     * @param $msg 驳回意见
     * @return bool
     * @throws Exception
     */
    public static function editStockOutReject($stockoutno, $msg)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_Outstock', false);
            $data = $Web->overruleFunc(['stockno' => $stockoutno, 'msg' => $msg]);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['stockoutno' => $stockoutno, 'msg' => $msg]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
            if ($data['status'] == 'success') {
                $result = [
                    'code' => 200,
                    'message' => $data['msg']
                ];
            } else {
                throw new Exception($data['msg'], 300);
            }
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            $result = [
                'code' => 300,
                'message' => $e->getMessage()
            ];
        }
        return $result;
    }

    /**
     *    货权转移驳回
     * @param $transstockno 货权转移编号
     * @param $msg 驳回意见
     * @return bool
     * @throws Exception
     */
    public static function edittransReject($transstockno, $msg)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_Transstock', false);
            $data = $Web->overruleFunc(['stockno' => $transstockno, 'msg' => $msg]);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['transstockno' => $transstockno, 'msg' => $msg]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
            if ($data['status'] == 'success') {
                $result = [
                    'code' => 200,
                    'message' => $data['msg']
                ];
            } else {
                throw new Exception($data['msg'], 300);
            }
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            $result = [
                'code' => 300,
                'message' => $e->getMessage()
            ];
        }
        return $result;
    }

    /**
     * CA验证
     * @param $ca_number CA编号
     * @return bool
     * @throws Exception
     */
    public static function vendorCa($ca_number)
    {
        try {
            $config = Yaf_Application::app()->getConfig();
            $rpc = $config->get("rpc");
            $vendorInstance = new VendorModel(Yaf_Registry :: get("db"), Yaf_Registry :: get('mc'));
            $vendorno = $vendorInstance -> getHengyangVendor();
            if(!$vendorno){
                throw new Exception('未找到仓储编号', 300);
            }
            $Web = \Hprose\Http\Client::create($rpc->host . '/Wms_Wms', false);
            $data = $Web->overruleFunc(['vendorno' => $vendorno, 'ca_number' => $ca_number]);
            error_log(date("Y-m-d H:i:s") . "\t" . json_encode(['vendorno' => $vendorno, 'ca_number' => $ca_number]) . PHP_EOL . "\t" . json_encode($data) . PHP_EOL, 3, './logs/phprpc.log');
            if ($data['status'] == 'success') {
                $result = [
                    'code' => 200,
                    'message' => $data['msg']
                ];
            } else {
                throw new Exception($data['msg'], 300);
            }
        } catch (Exception $e) {
            error_log(date("Y-m-d H:i:s") . PHP_EOL . $e->getMessage(), 3, './logs/phpinput_error.log');
            $result = [
                'code' => 300,
                'message' => $e->getMessage()
            ];
        }
        return $result;
    }

    //金额转化中文大写
    function num_to_rmb($num)
    {
        $c1 = "零壹贰叁肆伍陆柒捌玖";
        $c2 = "分角元拾佰仟万拾佰仟亿";
        //精确到分后面就不要了，所以只留两个小数位
        $num = round($num, 2);
        //将数字转化为整数
        $num = $num * 100;
        // if (strlen($num) > 10) {
        //     return "金额太大，请检查";
        // } 
        $i = 0;
        $c = "";
        while (1) {
            if ($i == 0) {
                //获取最后一位数字
                $n = substr($num, strlen($num) - 1, 1);
            } else {
                $n = $num % 10;
            }
            //每次将最后一位数字转化为中文
            $p1 = substr($c1, 3 * $n, 3);
            $p2 = substr($c2, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            //去掉数字最后一位了
            $num = $num / 10;
            $num = (int)$num;
            //结束循环
            if ($num == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            //utf8一个汉字相当3个字符
            $m = substr($c, $j, 6);
            //处理数字中很多0的情况,每次循环去掉一个汉字“零”
            if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j - 3;
                $slen = $slen - 3;
            }
            $j = $j + 3;
        }
        //这个是为了去掉类似23.0中最后一个“零”字
        if (substr($c, strlen($c) - 3, 3) == '零') {
            $c = substr($c, 0, strlen($c) - 3);
        }
        //将处理的汉字加上“整”
        if (empty($c)) {
            return "零元整";
        } else {
            return $c . "整";
        }
    }

    //月份
    public static function getMonth($month)
    {
        switch ($month) {
            case '1':
                return '一月份';
            case '2':
                return '二月份';
            case '3':
                return '三月份';
            case '4':
                return '四月份';
            case '5':
                return '五月份';
            case '6':
                return '六月份';
            case '7':
                return '七月份';
            case '8':
                return '八月份';
            case '9':
                return '九月份';
            case '10':
                return '十月份';
            case '11':
                return '十一月份';
            case '12':
                return '十二月份';
        }
    }
}
