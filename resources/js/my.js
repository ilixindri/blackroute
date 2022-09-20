
window.zipf = function(e) {
    let c = e.value.replace(/[^0-9]/g, '');
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
