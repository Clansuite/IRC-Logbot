window.onload=function() {
    if (!document.getElementById || !document.createElement) return;

    var f=document.createElement('form');
    var st=document.createElement('strong');
    var st_tn=document.createTextNode('You can show/filter: ');
    st.appendChild(st_tn);
        st.appendChild(document.createElement('br'));
    f.id='dynamic'; f.appendChild(st);

    var s1=document.createElement('span');
    var c1=document.createElement('input');
    var t1=document.createTextNode(" JOIN's ");
    c1.id = 'join'; c1.type = 'checkbox';
    c1.checked = c1.defaultChecked = true;
    c1.title=s1.title='Show/hide when somebody joins the channel';
    c1.onclick = function(){$(".irc-green").parent().toggle();};
    s1.appendChild(c1); s1.appendChild(t1); f.appendChild(s1);

    var s2=document.createElement('span');
    var c2=document.createElement('input');
    var t2=document.createTextNode(" QUIT's/PART's ");
    c2.id = 'quit'; c2.type = 'checkbox';
    c2.checked = c2.defaultChecked=true;
    c2.title = s2.title = 'Show/hide when somebody leaves the channel';
    c2.onclick = function(){$(".irc-navy").parent().toggle();};
    s2.appendChild(c2); s2.appendChild(t2); f.appendChild(s2);

    var s3=document.createElement('span');
    var c3=document.createElement('input');
    var t3=document.createTextNode(" MODE's ");
    c3.id = 'mode'; c3.type = 'checkbox';
    c3.checked = c3.defaultChecked = false;
    c3.title = s3.title = 'Show/hide when somebody uses /MODE';
    c3.onclick = function(){$(".irc-brick").parent().toggle();};
    s3.appendChild(c3); s3.appendChild(t3); f.appendChild(s3);

    var s4=document.createElement('span');
    var c4=document.createElement('input');
    var t4=document.createTextNode(" TOPICS's ");
    c4.id = 'topic'; c4.type = 'checkbox';
    c4.checked = c4.defaultChecked = false;
    c4.title = s4.title = 'Show/hide when somebody uses /TOPIC';
    c4.onclick = function(){$(".irc-brown").parent().toggle();};
    s4.appendChild(c4); s4.appendChild(t4); f.appendChild(s4);

    var s5=document.createElement('span');
    var c5=document.createElement('input');
    var t5=document.createTextNode(' IrcBot ');
    c5.id = 'show_bot'; c5.type = 'checkbox';
    c5.checked = c5.defaultChecked = false;
    c5.title = s5.title = 'Show/hide messages by bot';
    c5.onclick= function(){$(".irc-green:contains('logbot')").parent().toggle();};
    s5.appendChild(c5); s5.appendChild(t5); f.appendChild(s5);

    var log = document.getElementById('log');
    log.parentNode.insertBefore(f,log);
}