<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-06-20
 * Time: 11:20
 */

namespace PoloDcApi\Core;


use PoloDcApi\Helper\Sign;
use PoloDcApi\Helper\Submit;
use PoloDcApi\Helper\Submit_Exception;

class Norm extends Comm {
    //重庆时时彩
    const CQ_SSC_HZ = "cq_ssc_hz";//和值
    const CQ_SSC_ZHB = "cq_ssc_zhb";//质合比
    const CQ_SSC_WW = "cq_ssc_ww";//万位
    const CQ_SSC_JOXT = "cq_ssc_joxt";//奇偶形态
    const CQ_SSC_BW = "cq_ssc_bw";//百位
    const CQ_SSC_JOB = "cq_ssc_job";//奇偶比
    const CQ_SSC_HZW = "cq_ssc_hzw";//和值尾
    const CQ_SSC_JBHM = "cq_ssc_jbhm";//基本号码
    const CQ_SSC_SW = "cq_ssc_sw";//十位
    const CQ_SSC_DXXT = "cq_ssc_dxxt";//大小形态
    const CQ_SSC_GW = "cq_ssc_gw";//个位
    const CQ_SSC_DXB = "cq_ssc_dxb";//大小比
    const CQ_SSC_KD = "cq_ssc_kd";//跨度
    const CQ_SSC_QW = "cq_ssc_qw";//千位
    const CQ_SSC_ZHXT = "cq_ssc_zhxt";//质合形态
    //大乐透
    const DLT_HZW = "dlt_hzw";//和值尾
    const DLT_JBHM = "dlt_jbhm";//基本号码
    const DLT_QQ5 = "dlt_qq5";//前区5
    const DLT_JOB = "dlt_job";//奇偶比
    const DLT_HQEM = "dlt_hqem";//后区二码
    const DLT_QQHZ = "dlt_qqhz";//前区和值
    const DLT_JOXT = "dlt_joxt";//奇偶形态
    const DLT_QQ3 = "dlt_qq3";//前区3
    const DLT_JJ = "dlt_jj";//极距
    const DLT_KD = "dlt_kd";//跨度
    const DLT_HQ1 = "dlt_hq1";//后区1
    const DLT_DXB = "dlt_dxb";//大小比
    const DLT_QQ1 = "dlt_qq1";//前区1
    const DLT_HZ = "dlt_hz";//和值
    const DLT_ZHXT = "dlt_zhxt";//质合形态
    const DLT_QQ4 = "dlt_qq4";//前区4
    const DLT_JH = "dlt_jh";//极和
    const DLT_HM = "dlt_hm";//号码
    const DLT_HQ2 = "dlt_hq2";//后区2
    const DLT_ZHB = "dlt_zhb";//质合比
    const DLT_QQ2 = "dlt_qq2";//前区2
    //广东11选5
    const GD_ECF_JBHM = "gd_ecf_jbhm";//基本号码
    const GD_EFC_D1W = "gd_efc_d1w";//第一位
    const GD_ECF_DXB = "gd_ecf_dxb";//大小比
    const GD_EFC_D4W = "gd_efc_d4w";//第四位
    const GD_ECF_DXXT = "gd_ecf_dxxt";//大小形态
    const GD_ECF_HW = "gd_ecf_hw";//和尾
    const GD_EFC_D2W = "gd_efc_d2w";//第二位
    const GD_ECF_ZHB = "gd_ecf_zhb";//质合比
    const GD_EFC_D5W = "gd_efc_d5w";//第五位
    const GD_ECF_ZHXT = "gd_ecf_zhxt";//质合形态
    const GD_ECF_HZ = "gd_ecf_hz";//和值
    const GD_ECF_JOB = "gd_ecf_job";//奇偶比
    const GD_EFC_D3W = "gd_efc_d3w";//第三位
    const GD_ECF_JOXT = "gd_ecf_joxt";//奇偶形态
    //江西11选5
    const JX_ECF_JOB = "jx_ecf_job";//奇偶比
    const JX_EFC_D3W = "jx_efc_d3w";//第三位
    const JX_ECF_JOXT = "jx_ecf_joxt";//奇偶形态
    const JX_ECF_HZ = "jx_ecf_hz";//和值
    const JX_EFC_D1W = "jx_efc_d1w";//第一位
    const JX_ECF_DXB = "jx_ecf_dxb";//大小比
    const JX_EFC_D4W = "jx_efc_d4w";//第四位
    const JX_ECF_DXXT = "jx_ecf_dxxt";//大小形态
    const JX_ECF_HW = "jx_ecf_hw";//和尾
    const JX_EFC_D2W = "jx_efc_d2w";//第二位
    const JX_ECF_ZHB = "jx_ecf_zhb";//质合比
    const JX_EFC_D5W = "jx_efc_d5w";//第五位
    const JX_ECF_JBHM = "jx_ecf_jbhm";//基本号码
    const JX_ECF_ZHXT = "jx_ecf_zhxt";//质合形态
    //排列三
    const PLS_SMFS = "p3_smfs";//四码复式
    const PLS_ACZ = "p3_acz";//AC值
    const PLS_ZHB = "p3_zhb";//质合比
    const PLS_BW = "p3_bw";//百位
    const PLS_HZ = "p3_hz";//和值
    const PLS_JOXT = "p3_joxt";//奇偶形态
    const PLS_JOB = "p3_job";//奇偶比
    const PLS_JBHM = "p3_jbhm";//基本号码
    const PLS_WMFS = "p3_wmfs";//五码复式
    const PLS_012LB = "p3_012lb";//012路比
    const PLS_SW = "p3_sw";//十位
    const PLS_HZW = "p3_hzw";//和值尾
    const PLS_DXXT = "p3_dxxt";//大小形态
    const PLS_DXB = "p3_dxb";//大小比
    const PLS_EMZH = "p3_emzh";//二码组合
    const PLS_LMFS = "p3_lmfs";//六码复式
    const PLS_PJZ = "p3_pjz";//平均值
    const PLS_GW = "p3_gw";//个位
    const PLS_KD = "p3_kd";//跨度
    const PLS_ZHXT = "p3_zhxt";//质合形态
    //福彩3D
    const SD_KD = "3d_kd";//跨度
    const SD_012LB = "3d_012lb";//012路比
    const SD_6MFS = "3d_6mfs";//六码复式
    const SD_ZHB = "3d_zhb";//质合比
    const SD_4MFS = "3d_4mfs";//四码复式
    const SD_HZ = "3d_hz";//和值
    const SD_SW = "3d_sw";//十位
    const SD_ZHXT = "3d_zhxt";//质合形态
    const SD_QYB = "3d_qyb";//奇偶比
    const SD_TJZ = "3d_tjz";//平均值
    const SD_ACZ = "3d_acz";//AC值
    const SD_JBHM = "3d_jbhm";//基本号码
    const SD_QOXT = "3d_qoxt";//奇偶形态
    const SD_HZW = "3d_hzw";//和值尾
    const SD_GW = "3d_gw";//个位
    const SD_5MFS = "3d_5mfs";//五码复式
    const SD_DXB = "3d_dxb";//大小比
    const SD_2MZH = "3d_2mzh";//二码组合
    const SD_BW = "3d_bw";//百位
    const SD_DXXT = "3d_dxxt";//大小形态
    //山东11选5
    const SD_ECF_ZHXT = "sd_ecf_zhxt";//质合形态
    const SD_ECF_JBHM = "sd_ecf_jbhm";//基本号码
    const SD_ECF_JOB = "sd_ecf_job";//奇偶比
    const SD_EFC_D1W = "sd_efc_d1w";//第一位
    const SD_ECF_JOXT = "sd_ecf_joxt";//奇偶形态
    const SD_EFC_D4W = "sd_efc_d4w";//第四位
    const SD_ECF_HZ = "sd_ecf_hz";//和值
    const SD_ECF_DXB = "sd_ecf_dxb";//大小比
    const SD_EFC_D2W = "sd_efc_d2w";//第二位
    const SD_ECF_DXXT = "sd_ecf_dxxt";//大小形态
    const SD_EFC_D5W = "sd_efc_d5w";//第五位
    const SD_ECF_HW = "sd_ecf_hw";//和尾
    const SD_ECF_ZHB = "sd_ecf_zhb";//质合比
    const SD_EFC_D3W = "sd_efc_d3w";//第三位
    //双色球
    const SSQ_DZXXT = "ssq_dzxxt";//大中小形态
    const SSQ_H3W = "ssq_h3w";//红3位
    const SSQ_DX = "ssq_dx";//大小
    const SSQ_DXB = "ssq_dxb";//大小比
    const SSQ_H6W = "ssq_h6w";//红6位
    const SSQ_WX = "ssq_wx";//五行
    const SSQ_JJ = "ssq_jj";//极距
    const SSQ_H1W = "ssq_h1w";//红1位
    const SSQ_ZF = "ssq_zf";//振幅
    const SSQ_ZHXT = "ssq_zhxt";//质合形态
    const SSQ_H4W = "ssq_h4w";//红4位
    const SSQ_ZH = "ssq_zh";//质合
    const SSQ_HZ = "ssq_hz";//和值
    const SSQ_ZHB = "ssq_zhb";//质合比
    const SSQ_JH = "ssq_jh";//极和
    const SSQ_WXXT = "ssq_wxxt";//五行形态
    const SSQ_QYXT = "ssq_qyxt";//奇偶形态
    const SSQ_H2W = "ssq_h2w";//红2位
    const SSQ_QO = "ssq_qo";//奇偶
    const SSQ_QYB = "ssq_qyb";//奇偶比
    const SSQ_H5W = "ssq_h5w";//红5位
    const SSQ_WS = "ssq_ws";//尾数
    const SSQ_ACZ = "ssq_acz";//AC值
    const SSQ_HZW = "ssq_hzw";//和值尾
    const SSQ_JBHM = "ssq_jbhm";//基本号码
    const SSQ_LQHM = "ssq_lqhm";//蓝球号码
    const SSQ_012LXT = "ssq_012lxt";//012路形态
    //天津时时彩
    const TJ_SSC_HZW = "tj_ssc_hzw";//和值尾
    const TJ_SSC_JOB = "tj_ssc_job";//奇偶比
    const TJ_SSC_QW = "tj_ssc_qw";//千位
    const TJ_SSC_JOXT = "tj_ssc_joxt";//奇偶形态
    const TJ_SSC_GW = "tj_ssc_gw";//个位
    const TJ_SSC_ZHB = "tj_ssc_zhb";//质合比
    const TJ_SSC_HZ = "tj_ssc_hz";//和值
    const TJ_SSC_ZHXT = "tj_ssc_zhxt";//质合形态
    const TJ_SSC_BW = "tj_ssc_bw";//百位
    const TJ_SSC_KD = "tj_ssc_kd";//跨度
    const TJ_SSC_DXB = "tj_ssc_dxb";//大小比
    const TJ_SSC_WW = "tj_ssc_ww";//万位
    const TJ_SSC_DXXT = "tj_ssc_dxxt";//大小形态
    const TJ_SSC_SW = "tj_ssc_sw";//十位
    //新疆时时彩
    const XJ_SSC_QW = "xj_ssc_qw";//千位
    const XJ_SSC_DXXT = "xj_ssc_dxxt";//大小形态
    const XJ_SSC_GW = "xj_ssc_gw";//个位
    const XJ_SSC_DXB = "xj_ssc_dxb";//大小比
    const XJ_SSC_KD = "xj_ssc_kd";//跨度
    const XJ_SSC_BW = "xj_ssc_bw";//百位
    const XJ_SSC_ZHXT = "xj_ssc_zhxt";//质合形态
    const XJ_SSC_HZ = "xj_ssc_hz";//和值
    const XJ_SSC_ZHB = "xj_ssc_zhb";//质合比
    const XJ_SSC_WW = "xj_ssc_ww";//万位
    const XJ_SSC_JOXT = "xj_ssc_joxt";//奇偶形态
    const XJ_SSC_SW = "xj_ssc_sw";//十位
    const XJ_SSC_JOB = "xj_ssc_job";//奇偶比
    const XJ_SSC_HZW = "xj_ssc_hzw";//和值尾

    /**
     * @param string $lottery 彩种
     * @param string $norm 指标标识
     * @throws Submit_Exception
     */
    public function last($lottery, $norm){
        $url = '/norm/last';
        $data = [
            'key' => $this->key,
            'format' => $this->format,
            'code' => $lottery,
            'norm' => $norm
        ];
        $data['secret'] = Sign::getSecret($data, $this->secret);
        $url = $this->makeUrl($url,$data);
        $request = new Submit();
        $result = $request->get($url);
        return $result['data'];
    }
}