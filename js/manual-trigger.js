!function(t,n){t.extend(t.infinitescroll.prototype,{_setup_twitter:function(){var n=this.options,e=this;t(n.nextSelector).click(function(t){1!=t.which||t.metaKey||t.shiftKey||(t.preventDefault(),e.retrieve())}),e.options.loading.start=function(t){t.loading.msg.appendTo(t.loading.selector).show(t.loading.speed,function(){e.beginAjax(t)})}},_showdonemsg_twitter:function(){var n=this.options;n.loading.msg.find("img").hide().parent().find("div").html(n.loading.finishedMsg).animate({opacity:1},2e3,function(){t(this).parent().fadeOut("normal")}),t(n.navSelector).fadeOut("normal"),n.errorCallback.call(t(n.contentSelector)[0],"done")}})}(jQuery);