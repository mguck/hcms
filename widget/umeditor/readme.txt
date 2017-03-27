<▆link href="/widget/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<▆script type="text/javascript" charset="gbk"  src="/widget/umeditor/umeditor.config.js"></script>
<▆script type="text/javascript" charset="gbk"  src="/widget/umeditor/umeditor.min.js"></script>
<▆script type="text/javascript" charset="gbk"  src="/widget/umeditor/lang/zh-cn/zh-cn.js"></script>

在控件中添加data-edit="um"
<▆textarea id="des" name="des" data-edit="um" style="display:none;"><▆/textarea> 
<▆script type="text/plain" id="umdes" style="width:700px;height:200px;"></script>   
 
js:
var um = UM.getEditor('umdes')