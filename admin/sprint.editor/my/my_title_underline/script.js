sprint_editor.registerBlock('my_title_underline', function($, $el, data, settings){
  data = $.extend({
    value: ''
  }, data);

  this.getData = function () {
    return data;
  };

  this.collectData = function(){
    data.value = $el.find('input').val()
    return data
  }
})