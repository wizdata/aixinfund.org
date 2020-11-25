// (c) 2010
// Author: VSV aka FOX
function radio_style_idx (conf) {
    var conf = {
        mask: (conf.mask || "label.radio_style"),
        class1: (conf.class1 || "radio_class1"),
        class2: (conf.class2 || "radio_class2"),
        hide_input: (conf.hide_input==null?true:conf.hide_input)
    };
    $(conf.mask).each(function() {
        var checked = $(this).find("input:checked").length > 0 ? 1 : 0;
        $(this)
            .removeClass(conf.class1)
            .removeClass(conf.class2)
            .addClass(checked==1?conf.class2:conf.class1);
        if (!$(this).hasClass("radio_style_idx_click")) {
            $(this)
                .addClass("radio_style_idx_click")
                .click(function() {
                    $(this).find("input").attr("checked",true);
                    radio_style_idx(conf);
                });
        };
        if (conf.hide_input==1 || conf.hide_input==true) {
            $(this).find("input").hide();
        };
    });
};