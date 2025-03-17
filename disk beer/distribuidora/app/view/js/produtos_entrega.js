let num = 1;
const itemModelo = itens.children[0];

function adicionarProduto(){
    const itens = document.getElementById("itens");
    const itemNovo = itemModelo.cloneNode(true);
    itemNovo.id = "item" + ++num;
    itemNovo.querySelector("#quantidade").value = 1;
    const select = itemNovo.querySelector("#mercadorias");
    const opcoes = Array.from(select.options);
    const selecione = opcoes.find(item => item.text === "Selecione");
    selecione.selected = true;
    itens.appendChild(itemNovo);
}

function removerProduto(elemento){
    const id = elemento.parentNode.id;
    console.log(id);
    const itens = document.getElementById("itens");
    const item = document.getElementById(id);
    itens.removeChild(item);
}

function validarProdutos(){
    const produtos = document.querySelectorAll("select[name='mercadorias[]']");
    const ids = [];
    for(let i = 0; i < produtos.length; i++){
        const id = produtos[i].value;
        if(ids.includes(id)){
            alert("Não é possível selecionar o mesmo produto mais de uma vez!");
            produtos[i].value = "";
            return;
        }
        if (id != "") ids.push(id);
    }
}

function nomearItens(){
    console.log("entrou");
    const divItens = document.querySelector('#itens');
    const itens = divItens.children;
    for (let i = 0; i < itens.length; i++) {
        if (i>0){
            itens[i].id = "item" + ++num;
        }
    }
}