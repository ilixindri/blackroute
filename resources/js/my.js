
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
var selectc = {};
window.selectf = function (field) {
    if(selectc.hasOwnProperty(field)) {
        console.log(-1);
        var aux = selectc[field];
    } else {
        console.log(1);
        var aux = 0;
        selectc[field] = 0;
    }
    var divv = document.createElement("div");
    divv.className = "col-span-6 sm:col-span-4";
    divv.id = 'div' + field + (aux+1)
    var labelv = document.getElementById('label'+field+'0');
    labelv = labelv.cloneNode(true);
    labelv.id = 'label' + field + (aux+1)
    divv.appendChild(labelv);
    var selectv = document.getElementById('div'+field+'0');
    selectv = selectv.cloneNode(true);
    divv.appendChild(selectv);
    var button_exclude_select = document.getElementById('button_exclude_select'+field+'0');
    button_exclude_select = button_exclude_select.cloneNode(true);
    button_exclude_select.id = 'exclude_select' + field + (aux+1)
    divv.appendChild(button_exclude_select);
    var button_add_select = document.getElementById('button_add_select'+field+'0');
    button_add_select = button_add_select.cloneNode(true);
    button_add_select.id = 'add_select' + field + (aux+1)
    divv.appendChild(button_add_select);

    newSelect.id = selectv.id.substring(0, selectv.id.length - 1) + (aux+1);
    console.log(newSelect.id);
    var selectl = document.getElementById('div'+field+aux);
    if (selectl) { console.log('ok'); console.log('div'+field+aux); console.log(selectl); }
    document.getElementById('add_select'+field+aux).style.display = 'none';
    selectl.parentNode.insertBefore(newSelect, selectl.nextSibling);
    selectc[field] += 1;
    console.log('done')
}
window.exclude_selectf = function (fieldKey) {
    var lastTwoChar = fieldKey.substr(fieldKey.length - 2);
    if (isNaN(lastTwoChar)) {
        var lastChar = fieldKey.substr(fieldKey.length - 1);
    }
    if (lastChar == 0) {
        document.getElementById('div'+fieldKey).value = "None";
    } else {
        var div_select = document.getElementById('div'+fieldKey)
        div_select.parentNode.removeChild(div_select);
    }
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
