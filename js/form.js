var Form = function(form, criteria) {
    this.validate = function() {
        var passed = true;
        var chkval = '';
        if(typeof form != 'object' || criteria == null || criteria == '') return false;
        jQuery.each(criteria, function(key, val) {
            chkval = ''; //clean chkval every time
            if(eval('form.' + key + '.length') > 1){
                //used to get 'radio' data
                 jQuery.each(eval('form.' + key), function(nk, nv) {
                    if(nv.checked) {
                        chkval = nv.value;
                        return false;
                    }
                 });
            }
            else {
                chkval = eval('form.' + key + '.value');
                chkval = chkval ? chkval : 'null';
            }
            
            jQuery.each(val, function(k, v) {
                if(k.indexOf('len') >= 0) {
                    if(check_len('', k.replace(/[^<>=]+/g, ''), chkval, k.replace(/[^\d]+/, ''))) {
                        _showmsg(v);
                        passed = false;
                        return passed;
                    }
                }
                else {
                    func = 'check_' + k;
                    if(eval(func + '(' + null + ', \'' + chkval +'\')')) {
                        _showmsg(v);
                        passed = false;
                        return passed;
                    }
                }
                
            });
            
            return passed;
        });
        return passed;
    };    
};

function check_empty(origin, chkval) {
    if(chkval == origin || chkval == '' || chkval == 'null') {
        return true;
    }
    return false;
}

function check_number(origin, chkval) {
    if(chkval == origin || chkval == '' || chkval == 'null' || isNaN(chkval)) {
        return true;
    }
    return false;
}

function check_len(origin, symbol, chkval, limit) {
    if(origin == chkval || chkval == null) return true;
    var str = 'mb_strlen(\''+chkval+'\')' + symbol + limit;
    return eval(str); 
}

function check_telephone(origin, chkval) {
    if(chkval == origin || chkval == '' || chkval == 'null' || 
    (chkval.length != 7 && chkval.length != 11) || chkval.match(/^[\d]{7}|[\d]{11}$/) == 'null') {
        return true;
    }
    return false;
}
//get the length of obj,(the count of attributes)
function objsize(obj) {
    if(typeof obj != 'object') return 0;
    var count = 0;
    jQuery.each(obj, function(k, v) {
        count++;
    });
    return count;
}
