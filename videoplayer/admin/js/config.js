function Save() {
  layer.msg('正在提交',{time:5000000});
      $.ajax({
      type : 'POST',
  data:$('#leleconfig').serialize(),
      url :'post.php?act=setting',  
      success : function (data) {
  layer.msg('保存完成',{time:1000});
      }
  });
  }


  function Reduction() {
  layer.confirm('确定恢复默认设置吗', {title: '提示'}, function() {
      $.ajax({
      type : 'POST',
      data:$('#leleconfig').serialize(),
      url :'post.php?act=reset',  
      success : function (data) {
      layer.msg('还原完成',{time: 1800},function () {parent.location.reload();});
      }
      });
  });
  }
  layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element','colorpicker', 'slider'], function(){
    var laydate = layui.laydate //日期
    ,laypage = layui.laypage //分页
    ,layer = layui.layer //弹层
    ,table = layui.table //表格
    //,carousel = layui.carousel //轮播
    //,upload = layui.upload //上传
    //,element = layui.element //元素操作
    ,slider = layui.slider
    ,form = layui.form
    ,laytpl = layui.laytpl
    ,admin = layui.admin,colorpicker = layui.colorpicker; 
  
   //执行一个 table 实例
    table.render({
      elem: '#dmlist'
      ,height: 'full-300'
      ,url: './dmku/?ac=list' //数据接口
      ,title: '用户表'
      ,page: true //开启分页
      //,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
      //,totalRow: true //开启合计行
      ,cols: [[ //表头
        //{type: 'checkbox', fixed: 'left'},
        {field: [4], title: 'ID',value:[4], width:80, align:'center',fixed: 'left', totalRowText: '合计：'}
        ,{field: [0], title: '弹幕id', align:'center', width: 300}
        ,{field: [5], title: '弹幕内容', align:'center', sort: true}
         ,{field: [2], title: '类型', align:'center', width: 90}
        ,{field: [3], title: '弹幕颜色', align:'center', width:150}
       ,{field: [1], title: '时间点', sort: true, sort: true, align:'center', width: 100}
        ,{field: [6], title: '发送IP', sort: true, align:'center', width:120} 
        ,{field: [7], title: '发送时间', sort: true, align:'center', width: 150}
        ,{field: [8], title: '弹幕大小', sort: true, align:'center', width: 105}
        ,{field: [9], title: '来源地址', align:'center', sort: true}
        ,{fixed: 'right',title: '操作', width: 180, align:'center', toolbar: '#listbar'}
      ]]
    });
    table.render({
      elem: '#dmreport'
      ,height: 'full-300'
      ,url: './dmku/?ac=reportlist' //数据接口
      ,title: '用户表'
      ,page: true //开启分页
      //,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
      //,totalRow: true //开启合计行
      ,cols: [[ //表头
  {field: [2], title: 'ID',value:[4], width:80, align:'center',fixed: 'left', totalRowText: '合计：'}
        ,{field: [0], title: '弹幕id', width:300, align:'center'}
        ,{field: [3], title: '弹幕内容', align:'center', sort: true}
        ,{field: [1], title: '举报类型', width:200, align:'center', sort: true} 
        ,{field: [4], title: '发送IP', width:400, align:'center', sort: true} 
        ,{field: [5], title: '发送时间', width: 300, align:'center', sort: true}
        ,{field: [6], title: '来源地址', align:'center', sort: true}
       ,{fixed: 'right',title: '操作', width: 240, align:'center', toolbar: '#reportbar'}
      ]]
    });
  table.on('toolbar(dmlist)', function(obj){
      var checkStatus = table.checkStatus(obj.config.id)
      ,data = checkStatus.data; //获取选中的数据
      switch(obj.event){
        case 'add':
          layer.msg('添加');
        break;
        case 'update':
          if(data.length === 0){
            layer.msg('请选择一行');
          } else if(data.length > 1){
            layer.msg('只能同时编辑一个');
          } else {
            layer.alert('编辑 [id]：'+ checkStatus.data[0].id);
          }
        break;
        case 'delete':
          if(data.length === 0){
            layer.msg('请选择一行');delete1()
         } else {
            layer.msg('删除');
          }
        break;
      };
    });
    table.on('toolbar(report)', function(obj){
      var checkStatus = table.checkStatus(obj.config.id)
      ,data = checkStatus.data; //获取选中的数据
      switch(obj.event){
        case 'add':
          layer.msg('添加');
        break;
        case 'update':
          if(data.length === 0){
            layer.msg('请选择一行');
          } else if(data.length > 1){
            layer.msg('只能同时编辑一个');
          } else {
            layer.alert('编辑 [id]：'+ checkStatus.data[0].id);
          }
        break;
        case 'delete':
          if(data.length === 0){
            layer.msg('请选择一行');delete1()
         } else {
            layer.msg('删除');
          }
        break;
      };
    });
    
    //监听行工具事件
    table.on('tool(dmlist)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
      var data = obj.data //获得当前行数据
      ,layEvent = obj.event; //获得 lay-event 对应的值
      if(layEvent === 'reffer'){
        window.open(data[9]);//新窗口打开
        //layer.open({type: 4, area: ["100%", "100%"], title: parent.document.title, move: false, content: "https://www.ipian.net/index.php/vod/detail/id/86353.html"});
      } else if(layEvent === 'detail'){
        layer.msg('查看操作');
      } else if(layEvent === 'del'){
        layer.confirm('真的删除行么', function(index){
          obj.del(); //删除对应行（tr）的DOM结构
          var dmid= data[4];
          delid (dmid);
           layer.close(index);
          //向服务端发送删除指令
        });
      } else if(layEvent === 'dmedit'){
   
          data.list = layui.data('bondTemplateList').list;
              var content = $("#bondTemplateList").html();
              laytpl(content).render(data, function (string) {
                  layer.open({
                      type: 1,
                      title: "修改弹幕",
                      area: ['800px', '350px'], //宽高
                      content: string
                  });
                  colorpicker.render({
                      elem: '#test-form'
                      //,color: '#1c97f5'
                      ,color: 'rgb(68,66,66)'
                      ,format: 'rgb' //默认为 hex
                         ,done: function(color){
                            $('#test-form-input').val(color);
                      }
                    });
  
              });
    }
    });
    table.on('tool(report)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
      var data = obj.data //获得当前行数据
      ,layEvent = obj.event; //获得 lay-event 对应的值
      if(layEvent === 'reffer'){
        window.open(data[6]);//新窗口打开
        //layer.open({type: 4, area: ["100%", "100%"], title: parent.document.title, move: false, content: "https://www.ipian.net/index.php/vod/detail/id/86353.html"});
      } else if(layEvent === 'detail'){
        layer.msg('查看操作');
      } else if(layEvent === 'del'){
        layer.confirm('真的删除行么', function(index){
          obj.del(); //删除对应行（tr）的DOM结构
          var dmid= data[2];
          delid (dmid);
          layer.close(index);
        });
      } else if(layEvent === 'edit'){
          layer.confirm('移除举报么', function(index){
          obj.del(); 
          var dmid= data[2];
          delreport (dmid);
          layer.close(index);
        });
      }
   });
     
   
  
   form.on('submit(bond_sumbit)', function (data) {
           layer.msg('正在提交',{time:5000000});
           $.ajax({
               type : 'POST',
               data:data.field,
               url :'/dmku/?ac=edit',  
               success : function (data) {
                   layer.msg('保存完成',{time:1000});
               }
          });
       })
       form.on('submit(reloadlst_submit)', function (data) {
            var key = $('#textdemo').val();
           table.render({
              elem: '#dmlist'
              ,height: 500
              ,url: '/dmku/?ac=so&key='+key //数据接口
              ,title: '用户表'
              //,page: true //开启分页
              //,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
              //,totalRow: true //开启合计行
              ,cols: [[ //表头
                {field: [4], title: 'ID',value:[4], width:50, align:'center',fixed: 'left', totalRowText: '合计：'}
                ,{field: [0], title: '弹幕id', align:'center', width:300}
                ,{field: [5], title: '弹幕内容', align:'center', width: 300, sort: true}
                 ,{field: [2], title: '类型', align:'center', width: 80,}
                ,{field: [3], title: '弹幕颜色', align:'center', width:150}
               ,{field: [1], title: '时间点', align:'center', width: 180, sort: true}
                ,{field: [6], title: '发送IP', align:'center', width:180, sort: true} 
                ,{field: [7], title: '发送时间', align:'center', width: 220, sort: true}
                ,{field: [8], title: '弹幕大小', align:'center', width: 180, sort: true}
                ,{field: [9], title: '来源地址', align:'center', sort: true}
                ,{fixed: 'right', title: '操作',width: 240, align:'center', toolbar: '#listbar'}
               ]]
            });
  
       })
   
   
      function delreport (id) {$.ajax({url: "/dmku/?ac=del&type=report&id="+id,success: function(data){}});}
      function delid (id) {$.ajax({url: "/dmku/?ac=del&type=list&id="+id,success: function(data){}});}
   });
  