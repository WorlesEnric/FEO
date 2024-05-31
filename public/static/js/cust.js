jQuery(function(){
    eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('i(".p-h .p-h 2").r(\'7\',e(9){        F G = i(\'.n-8\').b(\'q.6\');        g(i(B).s().t(\'.p-h\').b(\'E\').l ==0){            i(".p-h.o-m:k").7();        }a{            G.b(\'.w-o\').y();            F d = i(B).t(\'.p-h\').b(\'.p-j\').A();            F x = i(B).5("C");            G.b(\'.c-o\').A(d);            G.b(\'.w-o\').A(x);            i(B).t(\'.p-h\').b("2.p-m").u(\'3\');            i(B).4(\'3\');            i(".p-h.o-m").u(\'3\')        }        1.v();    });    i(".p-h.o-m").r(\'7\',e(){        i(B).z(\'.o-m\').u(\'3\');       i(\'.p-h.3 .p-m\').7();       i(\'.p-h .3\').u(\'3\');       i(B).4(\'3\');       F G = i(\'.n-8\').b(\'q.6\');       F D = i(B).b(\'.p-j\').A();       G.b(\'.c-o\').A(D);            G.b(\'.w-o\').f();            1.v();    });',62,43,'|Pace|a|active|addClass|attr|breadcrumb|click|content|e|else|find|first|firstMenu|function|hide|if|item|jQuery|label|last|length|link|main|menu|nav|ol|on|parent|parents|removeClass|restart|second|secondMenu|show|siblings|text|this|toId|txt|ul|var|wrap'.split('|'),0,{}))

    jQuery("#changeRightBg").on('input propertychange',function(){
        console.log(78988989);
        console.log(jQuery(this).val());
        var elNode = jQuery("#right-sidebar");
        if(elNode.hasClass('blockRight')){
            elNode.removeClass('blockRight')
        }else{
            elNode.addClass('blockRight')
        }
    })
    jQuery("#changeSearch").on('input propertychange',function(){
        var searchbar = jQuery(".searchbar");
        if(searchbar.hasClass("hide")){
            searchbar.removeClass('hide');
        }else{
            searchbar.addClass('hide');
        }
    });
});