/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************!*\
  !*** ./resources/js/my.js ***!
  \****************************/
window.zipf = function (e) {
  var c = e.value.replace(/[^0-9]/g, '');
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

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        var response = JSON.parse(xhr.responseText);
        document.getElementById('logradouro').value = response.logradouro;
        document.getElementById('bairro').value = response.bairro;
        document.getElementById('state').value = response.localidade + ' - ' + response.uf;
      }
    };

    xhr.send();
  }
};

window.formfc = function (formv, msg) {
  if (confirm(msg)) {
    document.getElementById(formv).submit();
  }
};

window.formf = function (formv) {
  document.getElementById(formv).submit();
};

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

  xhr.onreadystatechange = function () {
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
  };
};

window.namef = function (e) {
  document.getElementById('message_div').style.display = 'none';
  /* get element input of type text by id; get value of this element; strip/trim this value; check if this value resulted of strip/trim has space */

  var valuev = e.value.trim();

  if (valuev.indexOf(' ') === -1) {
    document.getElementById('message_div').style.display = 'block';
    document.getElementById('message').innerHTML = 'Nome de cliente inválido. Deve ser preenchido nome e sobrenome.';
  }
};

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
};

window.valuef = function (e) {
  var c = e.value.replace(/[^0-9]/g, '');

  if (c % 100 < 10) {
    var lastTwo = '0' + c % 100;
  } else {
    var lastTwo = c % 100;
  }

  e.value = 'R$ ' + Math.floor(c / 100) + "," + lastTwo;
};

window.value_onload = function (idv) {
  var e = document.getElementById(idv);
  e.value = e.value.replace('.', ',');
};
/* create one observer to change page when change url ancor */
// para ao usar o botao de voltar selecionar o campo do form correto


var observer = new MutationObserver(function (mutations) {
  mutations.forEach(function (mutation) {
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
/******/ })()
;