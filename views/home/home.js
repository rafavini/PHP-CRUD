import { API_URL } from "../js/utils.js";


document.addEventListener("DOMContentLoaded", function (event) {

    const limit = 5
    let currentpage = 0


    async function BuscarDados(page=0){
        const offset = page * limit 
        const response = await fetch(`${API_URL}?acao=teste&limit=${limit}&offset=${offset}`,{
            method: "POST"
        })
        const dados = await response.json()
        console.log(dados)
    }

    BuscarDados()
  });