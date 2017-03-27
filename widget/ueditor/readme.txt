<▆script type="text/javascript" charset="gbk"  src="/widget/ueditor/ueditor.config.js"></script>
<▆script type="text/javascript" charset="gbk"  src="/widget/ueditor/ueditor.all.min.js"> </script>
<▆script type="text/javascript" charset="gbk"  src="/widget/ueditor/lang/zh-cn/zh-cn.js"></script>    

在控件中添加data-edit="ue"
<▆textarea id="des" name="des" data-edit="ue" style="display:none;"></textarea>
<▆script type="text/plain" id="uedes" style="width:100%;height:400px;"></script>
js:
var ue = UE.getEditor('uedes');  