function proccessPayment(e,t){let n={card_token:e,hash:PagSeguroDirectPayment.getSenderHash(),installment:document.querySelector("select.select_installments").value,card_name:document.querySelector("input[name=card_name]").value,_token:csrf};$.ajax({type:"POST",url:urlProccess,data:n,dataType:"json",success:function(e){toastr.success(e.data.message,"Sucesso"),window.location.href=`${urlThanks}?order=${e.data.order}`},error:function(e){t.disabled=!1,t.innerHTML="Efetuar Pagamento";let n=JSON.parse(e.responseText);document.querySelector("div.msg").innerHTML=showErrorMessages(n.data.message.error.message)}})}function getInstallments(e,t){PagSeguroDirectPayment.getInstallments({amount:e,brand:t,maxInstallmentNoInterest:0,success:function(e){let n=drawSelectInstallments(e.installments[t]);document.querySelector("div.installments").innerHTML=n},error:function(e){console.log(e)},complete:function(e){}})}function drawSelectInstallments(e){let t="<label>Opções de Parcelamento:</label>";t+='<select class="form-control select_installments">';for(let n of e)t+=`<option value="${n.quantity}|${n.installmentAmount}">${n.quantity}x de ${n.installmentAmount} - Total fica ${n.totalAmount}</option>`;return t+="</select>",t}function showErrorMessages(e){return`\n        <div class="alert alert-danger">${e}</div>\n    `}function errorsMapPagseguroJS(e){switch(e){case"10000":return"Bandeira do cartão inválida!";case"10001":return"Número do Cartão com tamanho inválido!";case"10002":case"30405":return"Data com formato inválido!";case"10003":return"Código de segurança inválido";case"10004":return"Código de segurança é obrigatório!";case"10006":return"Tamanho do código de segurança inválido!";default:return"Houve um erro na validação do seu cartão de crédito!"}}
