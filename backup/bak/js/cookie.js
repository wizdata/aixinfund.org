var cookie = {
    set: function (name, value, expiredays, path, domain, secure) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate()+expiredays);
        var expires = ((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
        document.cookie =
            name + "=" + escape(value) +
            ((expires) ? "; expires=" + expires : "") +
            ((path) ? "; path=" + path : "") +
            ((domain) ? "; domain=" + domain : "") +
            ((secure) ? "; secure" : "");
    },
    get: function (name) {
        var cookie = " " + document.cookie;
        var search = " " + name + "=";
        var setStr = null;
        var offset = 0;
        var end = 0;
        if (cookie.length > 0) {
            offset = cookie.indexOf(search);
            if (offset != -1) {
                offset += search.length;
                end = cookie.indexOf(";", offset)
                if (end == -1) {
                    end = cookie.length;
                };
                setStr = unescape(cookie.substring(offset, end));
            };
        };
        return(setStr);
    },
    del: function (name, path, domain) {
        if (this.get(name)) {
            document.cookie =
                name + "=" +
                ";expires=Thu, 01-Jan-1970 00:00:01 GMT" +
                ((path) ? "; path=" + path : "") +
                ((domain) ? "; domain=" + domain : "");
        };
    },
    getList: function () {
        var list = { };
        if (document.cookie && document.cookie != '') {
            var split = document.cookie.split(';');
            for (var i = 0; i < split.length; i++) {
                var name_value = split[i].split("=");
                name_value[0] = name_value[0].replace(/^ /, '');
                list[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
            };
        };
        return list;
    }
};