
window.zipf = function(e) {
    let c = e.value.replace(/[^0-9]/g, '');
    e.value = c;
    if (c.length == 8) {
        document.getElementById('logradouro').value = "Carregando...";
        document.getElementById('bairro').value = "Carregando...";
        document.getElementById('state').value = "Carregando...";
        document.getElementById('number').value = "";
        document.getElementById('complemento').value = "";
        /* request GET */
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://viacep.com.br/ws/' + c + '/json/', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('logradouro').value = response.logradouro;
                document.getElementById('bairro').value = response.bairro;
                document.getElementById('state').value = response.localidade + ' - ' + response.uf;
            }
        };
        xhr.send();
    }
}
window.formfc = function (formv, msg) { if(confirm(msg)) { document.getElementById(formv).submit() } }
window.formf = function (formv) { document.getElementById(formv).submit() }
window.ctof = function (e) {
    var idv = e.options[e.selectedIndex].value;
    var domainv = document.domain;
    var protocolv = document.location.protocol;
    /* check if has port in url */
    /* check if has '/' in port */
    var auxv = window.location.href;
    var portv = auxv.split(':')[2];
    if (portv) {
        if (portv.indexOf('/') > -1) {
            portv = portv.split('/')[0];
        }
        var urlv = protocolv + '//' + domainv + ':' + portv + '/api/ctos/' + idv;
    } else {
        var urlv = protocolv + '//' + domainv + '/api/ctos/' + idv;
    }
    /* organize the code in order correct */
    var xhr = new XMLHttpRequest();
    xhr.open('GET', urlv, true);
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            var json = JSON.parse(xhr.responseText);
            ;
            /* populate select with n option with value and text equals to i */
            var selectv = document.getElementById('splitter');
            for (var i = 1; i != json['splitter'] + 1; i++) {
                var optionv = document.createElement('option');
                optionv.value = i;
                optionv.text = i;
                selectv.appendChild(optionv);
            }
        }
    }
}
window.namef = function (e) {
    document.getElementById('message_div').style.display = 'none';
    /* get element input of type text by id; get value of this element; strip/trim this value; check if this value resulted of strip/trim has space */
    var valuev = e.value.trim();
    if (valuev.indexOf(' ') === -1) {
        document.getElementById('message_div').style.display = 'block';
        document.getElementById('message').innerHTML = 'Nome de cliente inválido. Deve ser preenchido nome e sobrenome.';
    }
}
window.expire_atf = function (expire_atv) {
   /* get date with input day next */
    var date = new Date();
    var day = date.getDate();
    if (day <= expire_atv) {
        var month = date.getMonth() + 1;
    } else {
        var month = date.getMonth() + 2;
    }
    month = month.toString().length == 1 ? '0' + month : month;
    day = expire_atv;
    day = day.toString().length == 1 ? '0' + day : day;
    var year = date.getFullYear();
    var nextDate = year + '-' + month + '-' + day;
    var ee = document.getElementById('expire_at');
    ee.value = nextDate;
}
window.valuef = function (e) {
    let c = e.value.replace(/[^0-9]/g, '');
    if (c%100 < 10) {
        var lastTwo = '0' + c%100;
    } else {
        var lastTwo = c%100;
    }
    e.value = 'R$ ' + Math.floor(c/100) + "," + lastTwo;
}
window.value_onload = function (idv) {
    var e = document.getElementById(idv);
    e.value = e.value.replace('.', ',');
}
var selects = {};
window.selectf = function (field) {
    console.log('start function selectf');
    var idv = '';
    if(selects.hasOwnProperty(field)) {
        console.log(-1);
        var aux = Math.max.apply(Math, selects[field]);
    } else {
        console.log(1);
        var aux = 0;
        selects[field] = [0];
    }
    var divv = document.createElement("div");
    divv.className = "col-span-6 sm:col-span-4";
    divv.id = 'div' + field + (aux+1)

    idv = 'label'+field+aux;
    var e = document.getElementById(idv);
    // if (e) { console.log(idv); console.log(e); }
    e = e.cloneNode(false);
    e.id = 'label' + field + (aux+1)
    // if (e) { console.log(e.id); console.log(e); }
    divv.appendChild(e);

    idv = field;
    var e = document.getElementById(idv);
    // if (e) { console.log(idv); console.log(e); }
    e = e.cloneNode(true);
    // if (e) { console.log(e.id); console.log(e); }
    divv.appendChild(e);

    idv = 'exclude_select'+field+aux;
    var e = document.getElementById(idv);
    // if (e) { console.log(idv); console.log(e); }
    e = e.cloneNode(true);
    e.onclick = function() {
        exclude_selectf(field, (aux+1));
    };
    e.id = 'exclude_select' + field + (aux+1)
    // if (e) { console.log(e.id); console.log(e); }
    e.className = "ml-1 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded";
    divv.appendChild(e);

    idv = 'add_select'+field+aux;
    var e = document.getElementById(idv);
    // if (e) { console.log(idv); console.log(e); }
    e = e.cloneNode(true);
    e.id = 'add_select' + field + (aux+1)
    e.className = "ml-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded";
    // if (e) { console.log(e.id); console.log(e); }
    divv.appendChild(e);

    var last_select_div = document.getElementById('div'+field+aux);
    if (last_select_div) { console.log('ok'); console.log('div'+field+aux); console.log(last_select_div); }
    document.getElementById('add_select'+field+aux).style.display = 'none';
    last_select_div.parentNode.insertBefore(divv, last_select_div.nextSibling);
    selects[field].push(aux+1);
}
window.exclude_selectf = function (field, key) {
    console.log('start function exclude_selectf')
    console.log('field: ' + field);
    console.log('key: '+key)
    console.log('selects', selects[field])
    if(selects.hasOwnProperty(field)) {
        var aux = selects[field].length;
        var maxv = selects[field].sort()[selects[field].length - 1];
        if (maxv == key) {
            maxv = selects[field][selects[field].length - 2]
        }
        console.log('maxv: ' + maxv);
    } else {
        var aux = 1;
    }
    console.log('aux: '+aux)
    if (aux == 1) {
        document.getElementById('div'+field + key).value = "None";
    } else {
        // idv = 'add_select'+field+key;
        // var e = document.getElementById(idv);
        // e = e.cloneNode(true);
        // e.id = 'add_select' + field + (key-1)
        // console.log('add_select_button', e)
        //
        // idv = 'div' + field + maxv
        // console.log('idv: ' + idv);
        // var divv = document.getElementById(idv)
        // console.log('div_select', divv)
        // if (divv) { console.log(divv.id); console.log(divv); }
        // divv.appendChild(e);

        document.getElementById('add_select'+field+maxv).style.display = '';

        var div_select = document.getElementById('div'+field + key)
        div_select.parentNode.removeChild(div_select);
        var index = selects[field].indexOf(key);
        if (index > -1) {
            selects[field].splice(index, 1);
        }
        console.log('selects', selects[field])
    }
    console.log('ending function exclude_selectf')
}
/* create one observer to change page when change url ancor */
// para ao usar o botao de voltar selecionar o campo do form correto
var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.type === 'childList') {
            var url = window.location.href;
            if (url.indexOf('#') > -1) {
                var ancor = url.substring(url.indexOf('#') + 1);
                if (ancor === 'hello') {
                    alert("ok");
                } else if (ancor === 'clear') {
                    while (document.body.firstChild) {
                        document.body.removeChild(document.body.firstChild);
                    }
                }
            }
        }
    });
});
