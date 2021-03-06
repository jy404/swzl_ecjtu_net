<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta property="wb:webmaster" content="a8a441cb988e35c7" />
<title>失物招领平台 - 华东交通大学日新网</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/beautiful-select.css" />
<style type="text/css">
<?php
    switch ($this->data['type'])
    {
        case 'zlxx':
            echo "#info-tab { background: -5px 0 no-repeat url('" . base_url() . "static/img/tab.png'); }";
            break;
        case 'xwxx':
            echo "#info-tab { background: -53px 0 no-repeat url('" . base_url() . "static/img/tab.png'); }";
            break;
    }
?>
</style>
<script type="text/javascript" src="/static/js/browser.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/beautiful-select.js"></script>
<script type="text/javascript">
var host = '<?php echo base_url(); ?>';
var hash = '<?php echo $this->security->get_csrf_hash(); ?>';
var path = '<?php echo $this->data['type']; ?>';
$(document).ready(function () {
    $('#search-text').one('click', function () {
        $(this).attr('value', '');
    })
    $('.info-content').find('a').hover(
        function () {
            $(this).parent().parent().find('td a').each(function () {
                $(this).css('textDecoration', 'underline');
            })
        },
        function () {
            $(this).parent().parent().find('td a').each(function () {
                $(this).css('textDecoration', 'none');
            })
        }
    );
    $('#cyxx').css('marginTop', '-32px');
    $('#cyxx + a').css('marginTop', '-32px');
    $('#fbqs + a').on('mouseover', function (event) {
        $('#fbqs').css('marginTop', '-32px');
        $('#fbqs + a').css('marginTop', '-32px');
    });
    $('#fbqs + a').on('mouseout', function (event) {
        $('#fbqs').css('marginTop', '-22px');
        $('#fbqs + a').css('marginTop', '-22px');
    });
    if ($.browser.msie) {
        $('#info tr:even').css('background-color', '#efefef');
        $('#info tr:odd').css('background-color', '#ffffff');
        $('#info tr:last-child').css('background-color', '#efefef');
    }
    $('#search-button').hover(
    	function(){
	    $(this).css('background-position','0 -34px ');
	},
	function(){
	    $(this).css('background-position','0 0');
	}
    )
});
</script>
</head>
<body>
<div id="header" style="background:39% 53% no-repeat url('<?php echo base_url() ?>/static/img/logo_new.png');">
<div class="nav">
            <ul>
                <li><a target="_blank" href="http://swzl.ecjtu.net/">失物招领</a></li>
                <li><a target="_blank" href="http://www.ecjtu.net/">日新网</a></li>
                <li id="weibo"><a target="_blank" href="http://e.weibo.com/u/2961853293">微博平台</a></li>
            </ul>
        </div>
    <!--<ul>
        <li><a href="http://www.ecjtu.net">日新网</a></li>
        <li><a href="http://swzl.ecjtu.net">失物招领</a></li>
    </ul>-->
</div>
<div id="container">
    <div id="content">
        
        <div id="sidebar">
            <p id="message-title">亲爱的同学</p>
            <p id="message-content">欢迎来到失物招领，我们会竭尽所能给您提供帮助！</p>
            <div class="sidebar-btn">
                <img alt="" src="<?php echo base_url() ?>static/img/cyxx.png" id="cyxx" />
                <a href="/" id="cyxx"></a>
                <img alt="" src="<?php echo base_url() ?>static/img/masklayer.png" class="masklayer" />
            </div>
            <div class="sidebar-btn">
                <img alt="" src="<?php echo base_url() ?>static/img/fbqs.png" id="fbqs" />
                <a style="background:#fff;opacity:0;filter:alpha(opacity=0);" href="/post"></a>
                <img alt="" src="<?php echo base_url() ?>static/img/masklayer.png" class="masklayer" />
            </div>
        </div>
        <div id="search">
            <?php echo form_open('search'); ?>
                <table class="searchbar">
                    <tr>
                        <td class="searchbar-select">
                            <div class="beautiful-select" style="display:none;">
                                <span class="bs-label"><a href="#">招领信息</a></span>
                                <ul class="bs-list bs-list-close" style="width:93px;">
                                    <li class="bs-option"><a  href="#" value="zlxx">招领信息</a></li>
				    <li class="bs-option"><a  href="#" value="xwxx">寻物信息</a></li>
                                </ul>
                            </div>
                            <select name="sslb" id="sslb">
                                <option value="zlxx">招领信息</option>
				<option value="xwxx">寻物信息</option>
                            </select>
                        </td>
                        <td class="searchbar-text">
                            <input type="text" value="搜索您丢失或捡到的物品" name="sslr" id="search-text" style="color:#696969;" />
                        </td>
                        <td class="searchbar-button">
                            <input type="submit" style="cursor:pointer;" value="" id="search-button" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="list">
            <div id="info-tab">
                <a href="/info/zlxx" id="zlxx"></a>
                <a href="/info/xwxx" id="xwxx"></a>
            </div>
            <table id="info">
                <tr id="info-head">
                    <td id="type">物品类型</td>
                    <td id="name">物品名称</td>
                    <td id="place">地点</td>
                    <td id="time">时间</td>
                    <td colspan="2" id="description">相关描述</td>
                </tr>
                <?php
                    $count = 0;
                    $per_page_count = $this->data['per_page_count'];
                    if ( ! empty($this->data['info']) )
                    {
                        foreach ($this->data['info'] as $info)
                        {
                            echo '<tr class="info-content">';
                            echo '<td class="type"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->cname . '</a></td>';
                            echo '<td class="name"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->name . '</a></td>';
                            echo '<td class="place"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->place . '</a></td>';
                            echo '<td class="time"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . date('Y-m-d', $info->time) . '</a></td>';
                            echo '<td class="description"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->description . '</a></td>';
                            echo '<td class="more"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">【详情】</td>';
                            echo '</tr>';
                            ++$count;
                        }
                    }
                    if ($count < $per_page_count)
                    {
                        for ($i = $count; $i < $per_page_count; ++$i)
                        {
                            echo '<tr class="info-content"><td class="type"></td><td class="name"></td><td class="place"></td><td class="time"></td><td class="description"></td><td class="more"></td></tr>';
                        }
                    }
                ?>
                <tr id="page">
                    <td colspan="6"><?php echo $this->data['page'];if($this->data['pages']>1) echo '<span style="color:#003399; padding-left:10px;">共'.$this->data['pages'].'页</span>';?></td>
                </tr>
                <tr id="not-found">
                    <td colspan="6" id="could-not-found">找不到？<a href="/post">点击此处发布启事</a></td>
                </tr>
            </table>
        </div>
        <div class="clearb"></div>
    </div>
</div>
<div id="footer">
    <p><a href="http://www.ecjtu.net/about/">关于我们</a> | <a href="http://123.ecjtu.net/">网址导航</a> | <a href="http://hr.ecjtu.net/">人才招聘</a> | <a href="mailto:roger@ecjtu.jx.cn">不良信息举报</a></p>
    <p>华东交通大学团委、学工处 [ 版权所有 交大日新 ] 赣ICP备05003322号 日新工作室 维护</p>
    <p>信箱：214@ecjtu.net CopyRight 2001-2012 By [ecjtu.net] All Right Reserved</p>
<p><script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fff331ba2aed9cae70b1ccaa481038182' type='text/javascript'%3E%3C/script%3E"));
</script></p>
</div>
</body>
</html>
